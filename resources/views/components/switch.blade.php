@php
    $resolvedName = $resolveName($attributes);
    $resolvedId = $resolveId($attributes);
    $isError = $hasError($resolvedName);
    $errMessage = $errorMessage($resolvedName);
    $describedBy = $ariaDescribedBy($resolvedId, $isError, (bool) ($hint || $description));

    $computedTrackClasses = $trackClasses($isError);
    $finalTrackClasses = $attributes->get('class')
        ? $mergeClasses($computedTrackClasses, $attributes->get('class'))
        : $computedTrackClasses;
@endphp

<div
    class="relative flex items-start gap-3"
    x-data="{ on: @js((bool) $checked) }"
>
    <div class="flex items-center">
        <button
            type="button"
            id="{{ $resolvedId }}"
            role="switch"
            :aria-checked="on.toString()"
            @if ($describedBy) aria-describedby="{{ $describedBy }}" @endif
            @if ($isError) aria-invalid="true" @endif
            :class="on ? 'bg-{{ $color }}' : 'bg-secondary/30 dark:bg-secondary/50'"
            {{ $attributes->except(['class', 'id', 'name', 'type', 'checked', 'required', 'disabled', 'readonly'])->merge(['class' => $finalTrackClasses]) }}
            x-on:click="if (!@js($disabled)) { on = !on; $refs.hiddenInput.value = on ? '1' : '0'; $refs.hiddenInput.dispatchEvent(new Event('change')) }"
            @disabled($disabled)
        >
            <span
                aria-hidden="true"
                class="{{ $thumbClasses() }}"
                :class="{{ $translateClasses() }}"
            ></span>
        </button>

        <input
            type="hidden"
            x-ref="hiddenInput"
            @if ($resolvedName) name="{{ $resolvedName }}" @endif
            :value="on ? '1' : '0'"
        />
    </div>

    <div class="text-sm">
        @if ($label)
            <label
                for="{{ $resolvedId }}"
                class="font-medium text-dark dark:text-light cursor-pointer select-none"
                x-on:click="if (!@js($disabled)) { on = !on; $refs.hiddenInput.value = on ? '1' : '0'; $refs.hiddenInput.dispatchEvent(new Event('change')) }"
            >
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
