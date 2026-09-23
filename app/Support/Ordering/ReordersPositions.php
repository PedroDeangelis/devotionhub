<?php

namespace App\Support\Ordering;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

/**
 * Keeps a sibling set ordered by a contiguous, zero-based `position` column.
 *
 * Every move rewrites the whole sibling set inside one locked transaction.
 * Lists here hold tens of rows at most, so a full rewrite is cheaper to reason
 * about than gap arithmetic and cannot drift when two admins drag at once.
 */
trait ReordersPositions
{
    /**
     * Move one row to a new index within its siblings.
     *
     * @param  Builder<static>  $scope  the sibling set, already constrained to one parent
     */
    public static function moveToPosition(Builder $scope, int $id, int $toIndex): void
    {
        DB::transaction(function () use ($scope, $id, $toIndex): void {
            $ids = static::orderedIds($scope);

            $from = array_search($id, $ids, true);

            if ($from === false) {
                return;
            }

            array_splice($ids, $from, 1);
            array_splice($ids, max(0, min($toIndex, count($ids))), 0, [$id]);

            static::writePositions($ids);
        });
    }

    /**
     * Close any gaps left by a delete.
     *
     * @param  Builder<static>  $scope
     */
    public static function resequence(Builder $scope): void
    {
        DB::transaction(function () use ($scope): void {
            static::writePositions(static::orderedIds($scope));
        });
    }

    /**
     * @param  Builder<static>  $scope
     * @return list<int>
     */
    protected static function orderedIds(Builder $scope): array
    {
        /** @var list<int> $ids */
        $ids = $scope->clone()
            ->reorder()
            ->orderBy('position')
            ->orderBy('id')
            ->lockForUpdate()
            ->pluck('id')
            ->all();

        return $ids;
    }

    /**
     * @param  list<int>  $ids
     */
    protected static function writePositions(array $ids): void
    {
        foreach ($ids as $index => $id) {
            static::query()->whereKey($id)->update(['position' => $index]);
        }
    }
}
