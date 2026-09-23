<?php

namespace App\Enums;

/**
 * The content blocks a lesson can be composed from.
 *
 * Each case owns its own payload shape (defaults) and validation rules, so the
 * two can never drift apart. Adding a block type means adding a case here and a
 * matching Blade component in resources/views/components/blocks.
 */
enum BlockType: string
{
    case Reading = 'reading';
    case Teaching = 'teaching';
    case KeyIdea = 'key_idea';
    case Reflection = 'reflection';
    case Prayer = 'prayer';
    case Complete = 'complete';
    case Prose = 'prose';

    public function label(): string
    {
        return match ($this) {
            self::Reading => "Today's reading",
            self::Teaching => 'The teaching',
            self::KeyIdea => 'Key idea',
            self::Reflection => 'Reflection',
            self::Prayer => 'Prayer',
            self::Complete => 'Complete',
            self::Prose => 'Prose',
        };
    }

    /**
     * A one-line description shown in the admin's "add block" palette.
     */
    public function description(): string
    {
        return match ($this) {
            self::Reading => 'A passage to read, with a scripture card.',
            self::Teaching => 'Prose teaching, with optional pull-quotes.',
            self::KeyIdea => 'A dark full-width card holding one idea.',
            self::Reflection => 'A question, and space for the student to write.',
            self::Prayer => 'A written prayer the student can mark complete.',
            self::Complete => 'The closing card that ends the lesson.',
            self::Prose => 'Free-form paragraphs, outside the numbered steps.',
        };
    }

    /**
     * Blocks carrying a numbered eyebrow chip (01, 02, …).
     *
     * The dark cards and free-form prose sit outside that sequence, which is why
     * numbering is computed over these cases only rather than the loop index.
     */
    public function isNumbered(): bool
    {
        return in_array($this, [self::Reading, self::Teaching, self::Reflection, self::Prayer], true);
    }

    /**
     * Blocks the student acts on rather than only reads.
     *
     * These are the ones that will need per-user progress records once that is
     * modelled; the flag exists now so the student view can branch on it.
     */
    public function isInteractive(): bool
    {
        return in_array($this, [self::Reflection, self::Prayer, self::Complete], true);
    }

    /**
     * The payload shape for a newly added block.
     *
     * LessonBlock::payload() merges stored data over these, so a view can read
     * any key without null-coalescing even if the row predates a new field.
     *
     * @return array<string, mixed>
     */
    public function defaults(): array
    {
        return match ($this) {
            self::Reading => [
                'heading' => '',
                'intro' => '',
                'reference' => '',
                'meta' => '',
            ],
            self::Teaching => [
                'heading' => '',
                'body' => [
                    ['kind' => 'paragraph', 'text' => ''],
                ],
            ],
            self::KeyIdea => [
                'eyebrow' => 'Key idea',
                'text' => '',
                'highlight' => '',
            ],
            self::Reflection => [
                'heading' => '',
                'helper' => '',
                'placeholder' => 'Write your private reflection. Encrypted. Yours alone.',
            ],
            self::Prayer => [
                'heading' => '',
                'text' => '',
                'highlight' => '',
            ],
            self::Complete => [
                'eyebrow' => '',
                'heading' => '',
                'text' => '',
                'button' => 'Complete lesson',
            ],
            self::Prose => [
                'body' => [
                    ['kind' => 'paragraph', 'text' => ''],
                ],
            ],
        };
    }

    /**
     * Validation for one block's data, keyed under the given prefix.
     *
     * Always call this with an explicit index (blocks.3.data), never a wildcard:
     * the rules differ per row, so a wildcard would apply the wrong ruleset.
     *
     * @return array<string, list<string>>
     */
    public function rules(string $prefix): array
    {
        return match ($this) {
            self::Reading => [
                "{$prefix}.heading" => ['required', 'string', 'max:160'],
                "{$prefix}.intro" => ['nullable', 'string', 'max:2000'],
                "{$prefix}.reference" => ['nullable', 'string', 'max:80'],
                "{$prefix}.meta" => ['nullable', 'string', 'max:120'],
            ],
            self::Teaching => [
                "{$prefix}.heading" => ['required', 'string', 'max:160'],
                "{$prefix}.body" => ['array'],
                "{$prefix}.body.*.kind" => ['required', 'in:paragraph,quote'],
                "{$prefix}.body.*.text" => ['nullable', 'string', 'max:4000'],
            ],
            self::KeyIdea => [
                "{$prefix}.eyebrow" => ['nullable', 'string', 'max:80'],
                "{$prefix}.text" => ['required', 'string', 'max:400'],
                "{$prefix}.highlight" => ['nullable', 'string', 'max:80'],
            ],
            self::Reflection => [
                "{$prefix}.heading" => ['required', 'string', 'max:300'],
                "{$prefix}.helper" => ['nullable', 'string', 'max:1000'],
                "{$prefix}.placeholder" => ['nullable', 'string', 'max:200'],
            ],
            self::Prayer => [
                "{$prefix}.heading" => ['required', 'string', 'max:160'],
                "{$prefix}.text" => ['required', 'string', 'max:1200'],
                "{$prefix}.highlight" => ['nullable', 'string', 'max:80'],
            ],
            self::Complete => [
                "{$prefix}.eyebrow" => ['nullable', 'string', 'max:120'],
                "{$prefix}.heading" => ['required', 'string', 'max:160'],
                "{$prefix}.text" => ['nullable', 'string', 'max:1000'],
                "{$prefix}.button" => ['required', 'string', 'max:60'],
            ],
            self::Prose => [
                "{$prefix}.body" => ['array'],
                "{$prefix}.body.*.kind" => ['required', 'in:paragraph,quote'],
                "{$prefix}.body.*.text" => ['nullable', 'string', 'max:4000'],
            ],
        };
    }
}
