@php
    $resolvedName = $resolveName($attributes);
    $resolvedId = $resolveId($attributes);
    $isError = $hasError($resolvedName);
    $errMessage = $errorMessage($resolvedName);
    $describedBy = $ariaDescribedBy($resolvedId, $isError, (bool) ($hint || $description));

    $computedClasses = $checkboxClasses($isError);
    $finalClasses = $attributes->get('class')
        ? $mergeClasses($computedClasses, $attributes->get('class'))
        : $computedClasses;
@endphp

<div class="relative flex items-start gap-2.5">
    <div class="flex items-center h-5">
        <input
            type="checkbox"
            id="{{ $resolvedId }}"
            @if ($resolvedName) name="{{ $resolvedName }}" @endif
            @if ($describedBy) aria-describedby="{{ $describedBy }}" @endif
            @if ($isError) aria-invalid="true" @endif
            @checked($checked)
            @required($required)
            @disabled($disabled)
            @readonly($readonly)
            {{ $attributes->except(['class', 'id', 'name', 'type', 'checked', 'required', 'disabled', 'readonly'])->merge(['class' => $finalClasses]) }}
        />
    </div>

    <div class="text-sm">
        @if ($label)
            <label for="{{ $resolvedId }}" class="font-medium text-dark dark:text-light cursor-pointer select-none">
                {{ $label }}
                @if ($required)
                    <span class="text-danger ms-0.5" aria-hidden="true">*</span>
                @endif
            </label>
        @endif

        @if ($description)
            <p id="{{ $resolvedId }}-description" class="text-xs text-secondary mt-0.5">
                {{ $description }}
            </p>
        @endif

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
</div>
