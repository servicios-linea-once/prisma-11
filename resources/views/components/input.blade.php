@php
    $resolvedName = $resolveName($attributes);
    $resolvedId = $resolveId($attributes);
    $isError = $hasError($resolvedName);
    $errMessage = $errorMessage($resolvedName);
    $hasLeading = (bool) ($prefix || $iconLeading || isset($slotPrefix));
    $hasTrailing = (bool) ($suffix || $iconTrailing || $clearable || isset($slotSuffix));
    $describedBy = $ariaDescribedBy($resolvedId, $isError, (bool) $hint);

    $computedClasses = $inputClasses($isError, $hasLeading, $hasTrailing);
    $finalClasses = $attributes->get('class')
        ? $mergeClasses($computedClasses, $attributes->get('class'))
        : $computedClasses;
@endphp

<div class="w-full space-y-1.5">
    @if ($label)
        <div class="flex items-center justify-between">
            <label for="{{ $resolvedId }}" class="block text-sm font-medium text-dark dark:text-light select-none">
                {{ $label }}
                @if ($required)
                    <span class="text-danger ms-0.5" aria-hidden="true">*</span>
                @endif
            </label>
        </div>
    @endif

    <div class="relative rounded-md">
        @if ($hasLeading)
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none text-secondary">
                @if ($iconLeading)
                    <x-prisma-icon name="{{ $iconLeading }}" size="{{ $size }}" />
                @elseif ($prefix)
                    <span class="text-sm font-medium">{{ $prefix }}</span>
                @elseif (isset($slotPrefix))
                    {{ $slotPrefix }}
                @endif
            </div>
        @endif

        <input
            type="{{ $type }}"
            id="{{ $resolvedId }}"
            @if ($resolvedName) name="{{ $resolvedName }}" @endif
            @if ($describedBy) aria-describedby="{{ $describedBy }}" @endif
            @if ($isError) aria-invalid="true" @endif
            @required($required)
            @disabled($disabled)
            @readonly($readonly)
            {{ $attributes->except(['class', 'id', 'name', 'type', 'required', 'disabled', 'readonly'])->merge(['class' => $finalClasses]) }}
        />

        @if ($hasTrailing)
            <div class="absolute inset-y-0 end-0 flex items-center pe-3 text-secondary">
                @if ($clearable)
                    <button
                        type="button"
                        class="text-secondary hover:text-dark dark:hover:text-light transition-colors p-0.5 focus:outline-none"
                        onclick="this.closest('div').previousElementSibling.value = ''; this.closest('div').previousElementSibling.dispatchEvent(new Event('input'))"
                        aria-label="{{ __('prisma::messages.close') }}"
                    >
                        <x-prisma-icon name="x" size="xs" />
                    </button>
                @elseif ($iconTrailing)
                    <x-prisma-icon name="{{ $iconTrailing }}" size="{{ $size }}" />
                @elseif ($suffix)
                    <span class="text-sm font-medium">{{ $suffix }}</span>
                @elseif (isset($slotSuffix))
                    {{ $slotSuffix }}
                @endif
            </div>
        @endif
    </div>

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
