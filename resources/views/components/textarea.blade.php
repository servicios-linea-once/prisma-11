@php
    $resolvedName = $resolveName($attributes);
    $resolvedId = $resolveId($attributes);
    $isError = $hasError($resolvedName);
    $errMessage = $errorMessage($resolvedName);
    $describedBy = $ariaDescribedBy($resolvedId, $isError, (bool) $hint);

    $computedClasses = $textareaClasses($isError);
    $finalClasses = $attributes->get('class')
        ? $mergeClasses($computedClasses, $attributes->get('class'))
        : $computedClasses;
@endphp

<div class="w-full space-y-1.5" @if ($showCounter && $maxlength) x-data="{ count: 0 }" @endif>
    @if ($label)
        <div class="flex items-center justify-between">
            <label for="{{ $resolvedId }}" class="block text-sm font-medium text-dark dark:text-light select-none">
                {{ $label }}
                @if ($required)
                    <span class="text-danger ms-0.5" aria-hidden="true">*</span>
                @endif
            </label>

            @if ($showCounter && $maxlength)
                <span class="text-xs text-secondary font-mono" x-text="`${count}/{{ $maxlength }}`"></span>
            @endif
        </div>
    @endif

    <textarea
        id="{{ $resolvedId }}"
        rows="{{ $rows }}"
        @if ($resolvedName) name="{{ $resolvedName }}" @endif
        @if ($maxlength) maxlength="{{ $maxlength }}" @endif
        @if ($describedBy) aria-describedby="{{ $describedBy }}" @endif
        @if ($isError) aria-invalid="true" @endif
        @if ($showCounter && $maxlength) x-on:input="count = $el.value.length" x-init="count = $el.value.length" @endif
        @required($required)
        @disabled($disabled)
        @readonly($readonly)
        {{ $attributes->except(['class', 'id', 'name', 'rows', 'maxlength', 'required', 'disabled', 'readonly'])->merge(['class' => $finalClasses]) }}
    >{{ $slot }}</textarea>

    @if ($isError)
        <p id="{{ $resolvedId }}-error" class="text-xs font-medium text-danger flex items-center gap-1 mt-1">
            <x-prisma-icon name="alert-circle" size="xs" class="shrink-0" />
            <span>{{ $errMessage }}</span>
        </p>
    @elseif ($hint)
        <p id="{{ $resolvedId }}-hint" class="text-xs text-secondary mt-1">
            {{ $hint }}
        </p>
    @endif
</div>
