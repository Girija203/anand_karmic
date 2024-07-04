@php
    $setting = App\Models\Setting::first();
    $lighterColor1 = lightenColor($setting->primary_color, 80);
    $lighterColor2 = lightenColor($setting->secondary_color, 80);
    $primary_hover_color = darken_color($setting->primary_color, 10);
    // $setting->primary_color = 'blue';
    // $setting->secondary_color = 'green';
    function lightenColor($hex, $percent)
    {
        // Convert hex to RGB
        $hex = str_replace('#', '', $hex);

        if (strlen($hex) == 3) {
            $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
            $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
            $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
        } else {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }

        // Calculate the lighter color
        $r = round($r + ($percent / 100) * (255 - $r));
        $g = round($g + ($percent / 100) * (255 - $g));
        $b = round($b + ($percent / 100) * (255 - $b));

        // Convert RGB back to hex
        $r = sprintf('%02x', $r);
        $g = sprintf('%02x', $g);
        $b = sprintf('%02x', $b);

        return '#' . $r . $g . $b;
    }

    function darken_color($color, $percent)
    {
        $color = trim($color, '#');

        if (strlen($color) === 3) {
            $color =
                str_repeat(substr($color, 0, 1), 2) .
                str_repeat(substr($color, 1, 1), 2) .
                str_repeat(substr($color, 2, 1), 2);
        }

        $r = hexdec(substr($color, 0, 2));
        $g = hexdec(substr($color, 2, 2));
        $b = hexdec(substr($color, 4, 2));

        $r = round(($r * (100 - $percent)) / 100);
        $g = round(($g * (100 - $percent)) / 100);
        $b = round(($b * (100 - $percent)) / 100);

        return '#' . sprintf('%02x%02x%02x', $r, $g, $b);
    }
@endphp

<style>
    :root {
        --tz-logo-lg-height: 18px;
        --tz-logo-sm-height: 22px;
        --tz-leftbar-width: 240px;
        --tz-leftbar-width-md: 160px;
        --tz-leftbar-width-sm: 70px;
        --tz-leftbar-condensed-height: 1500px;
        --tz-topbar-height: 70px;
        --tz-menu-item-icon-size: 1.1rem;
        --tz-menu-item-icon-width: 40px;
        --tz-menu-item-font-size: 0.925rem;
        --tz-menu-item-padding-x: 10px;
        --tz-menu-item-padding-y: 10px;
        --tz-footer-height: 60px;
        --tz-theme-card-border-width: 0px;
    }

    html[data-menu-color=light] {
        --tz-menu-bg: #ffffff;
        --tz-menu-item-color: #495057;
        --tz-menu-item-hover-color: {{ $setting->primary_color }};
        --tz-menu-item-active-color: {{ $setting->primary_color }};
        --tz-menu-item-active-bg: rgba(59, 192, 195, 0.07);
        --tz-menu-condensed-link-bg: #313a46;
    }

    html[data-menu-color=dark] {
        --tz-menu-bg: #1a2942;
        --tz-menu-item-color: #70809a;
        --tz-menu-item-hover-color: {{ $setting->primary_color }};
        --tz-menu-item-active-color: {{ $setting->primary_color }};
        --tz-menu-item-active-bg: rgba(255, 255, 255, 0.07);
        --tz-menu-condensed-link-bg: #162339;
    }

    html[data-bs-theme=dark][data-menu-color=light],
    html[data-bs-theme=dark][data-menu-color=dark] {
        --tz-menu-bg: #313a46;
        --tz-menu-item-color: #8391a2;
        --tz-menu-item-hover-color: #bccee4;
        --tz-menu-item-active-color: #ffffff;
        --tz-menu-item-active-bg: rgba(255, 255, 255, 0.07);
        --tz-menu-condensed-link-bg: #313a46;
    }

    html[data-topbar-color=light] {
        --tz-topbar-bg: #ffffff;
        --tz-topbar-item-color: #495057;
        --tz-topbar-item-hover-color: {{ $setting->primary_color }};
        --tz-topbar-search-bg: #f3f3f8;
    }

    html[data-topbar-color=dark] {
        --tz-topbar-bg: #313a46;
        --tz-topbar-item-color: #8391a2;
        --tz-topbar-item-hover-color: #bccee4;
        --tz-topbar-search-bg: #464f5b;
    }

    html[data-bs-theme=dark][data-topbar-color=light],
    html[data-bs-theme=dark][data-topbar-color=dark] {
        --tz-topbar-bg: #2f3742;
        --tz-topbar-item-color: #8391a2;
        --tz-topbar-item-hover-color: #bccee4;
        --tz-topbar-search-bg: #363f4a;
    }

    .border-dashed {
        border-style: dashed !important;
    }

    .bg-pink-subtle {
        background-color: var(--tz-pink-bg-subtle) !important;
    }

    .bg-purple-subtle {
        background-color: var(--tz-purple-bg-subtle) !important;
    }

    :root,
    [data-bs-theme=light] {
        --tz-blue: #4489e4;
        --tz-indigo: #33b0e0;
        --tz-purple: #716cb0;
        --tz-pink: #f24f7c;
        --tz-red: #d03f3f;
        --tz-orange: #fd7e14;
        --tz-yellow: #edc755;
        --tz-green: #47ad77;
        --tz-teal: #02a8b5;
        --tz-cyan: {{ $setting->primary_color }};
        --tz-black: #000;
        --tz-white: #fff;
        --tz-gray: #6c757d;
        --tz-gray-dark: #36404c;
        --tz-gray-100: #f8f9fa;
        --tz-gray-200: #f2f2f7;
        --tz-gray-300: #dee2e6;
        --tz-gray-400: #ced4da;
        --tz-gray-500: #adb5bd;
        --tz-gray-600: #6c757d;
        --tz-gray-700: #495057;
        --tz-gray-800: #36404c;
        --tz-gray-900: #212529;
        --tz-primary: {{ $setting->primary_color }};
        --tz-secondary: #6c757d;
        --tz-success: #4489e4;
        --tz-info: #33b0e0;
        --tz-warning: #edc755;
        --tz-danger: #d03f3f;
        --tz-purple: #716cb0;
        --tz-pink: #f24f7c;
        --tz-light: #f2f2f7;
        --tz-dark: #212529;
        --tz-primary-rgb: 59, 192, 195;
        --tz-secondary-rgb: 108, 117, 125;
        --tz-success-rgb: 68, 137, 228;
        --tz-info-rgb: 51, 176, 224;
        --tz-warning-rgb: 237, 199, 85;
        --tz-danger-rgb: 208, 63, 63;
        --tz-purple-rgb: 113, 108, 176;
        --tz-pink-rgb: 242, 79, 124;
        --tz-light-rgb: 242, 242, 247;
        --tz-dark-rgb: 33, 37, 41;
        --tz-primary-text-emphasis: {{ $primary_hover_color }};
        --tz-secondary-text-emphasis: #616971;
        --tz-success-text-emphasis: #3d7bcd;
        --tz-info-text-emphasis: #2e9eca;
        --tz-warning-text-emphasis: #d5b34d;
        --tz-danger-text-emphasis: #bb3939;
        --tz-pink-text-emphasis: #da4770;
        --tz-purple-text-emphasis: #66619e;
        --tz-light-text-emphasis: #ced4da;
        --tz-dark-text-emphasis: #495057;
        --tz-primary-bg-subtle: {{ $lighterColor1 }};
        --tz-secondary-bg-subtle: {{ $lighterColor2 }};
        --tz-success-bg-subtle: #dae7fa;
        --tz-info-bg-subtle: #d6eff9;
        --tz-warning-bg-subtle: #fbf4dd;
        --tz-danger-bg-subtle: #f6d9d9;
        --tz-pink-bg-subtle: #fcdce5;
        --tz-purple-bg-subtle: #e3e2ef;
        --tz-light-bg-subtle: #fcfcfd;
        --tz-dark-bg-subtle: #ced4da;
        --tz-primary-border-subtle: #addff3;
        --tz-secondary-border-subtle: #f2f2f7;
        --tz-success-border-subtle: #b4d0f4;
        --tz-info-border-subtle: #b1e6e7;
        --tz-warning-border-subtle: #f8e9bb;
        --tz-danger-border-subtle: #ecb2b2;
        --tz-pink-border-subtle: #fab9cb;
        --tz-purple-border-subtle: #c6c4df;
        --tz-light-border-subtle: #f2f2f7;
        --tz-dark-border-subtle: #adb5bd;
        --tz-white-rgb: 255, 255, 255;
        --tz-black-rgb: 0, 0, 0;
        --tz-font-sans-serif: "Lato", sans-serif;
        --tz-font-monospace: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
        --tz-gradient: linear-gradient(180deg, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0));
        --tz-body-font-family: var(--tz-font-sans-serif);
        --tz-body-font-size: 0.875rem;
        --tz-body-font-weight: 400;
        --tz-body-line-height: 1.5;
        --tz-body-color: #6c757d;
        --tz-body-color-rgb: 108, 117, 125;
        --tz-body-bg: #eaf1f3;
        --tz-body-bg-rgb: 234, 241, 243;
        --tz-emphasis-color: #000;
        --tz-emphasis-color-rgb: 0, 0, 0;
        --tz-secondary-color: rgba(108, 117, 125, 0.75);
        --tz-secondary-color-rgb: 108, 117, 125;
        --tz-secondary-bg: #fff;
        --tz-secondary-bg-rgb: 255, 255, 255;
        --tz-tertiary-color: #313539;
        --tz-tertiary-color-rgb: 49, 53, 57;
        --tz-tertiary-bg: #f8f9fa;
        --tz-tertiary-bg-rgb: 248, 249, 250;
        --tz-heading-color: inherit;
        --tz-link-color: {{ $setting->primary_color }};
        --tz-link-color-rgb: 59, 192, 195;
        --tz-link-decoration: none;
        --tz-link-hover-color: {{ $setting->primary_color }};
        --tz-link-hover-color-rgb: 50, 163, 166;
        --tz-code-color: {{ $setting->primary_color }};
        --tz-highlight-bg: #fbf4dd;
        --tz-border-width: 1px;
        --tz-border-style: solid;
        --tz-border-color: #dee2e6;
        --tz-border-color-translucent: rgba(0, 0, 0, 0.175);
        --tz-border-radius: 0.375rem;
        --tz-border-radius-sm: 0.25rem;
        --tz-border-radius-lg: 0.5rem;
        --tz-border-radius-xl: 1rem;
        --tz-border-radius-xxl: 2rem;
        --tz-border-radius-2xl: var(--tz-border-radius-xxl);
        --tz-border-radius-pill: 50rem;
        --tz-box-shadow: 0 1px 3px rgba(27, 23, 30, 0.1);
        --tz-box-shadow-sm: 0 0.125rem 0.25rem rgba(var(--tz-body-color-rgb), 0.15);
        --tz-box-shadow-lg: 0 0 45px 0 rgba(var(--tz-body-color-rgb), 0.2);
        --tz-box-shadow-inset: inset 0 1px 2px rgba(var(--tz-body-color-rgb), 0.075);
        --tz-focus-ring-width: 0.25rem;
        --tz-focus-ring-opacity: 0.25;
        --tz-focus-ring-color: rgba(59, 192, 195, 0.25);
        --tz-form-valid-color: #4489e4;
        --tz-form-valid-border-color: #4489e4;
        --tz-form-invalid-color: #d03f3f;
        --tz-form-invalid-border-color: #d03f3f;
    }

    [data-bs-theme=dark] {
        color-scheme: dark;
        --tz-body-color: #aab8c5;
        --tz-body-color-rgb: 170, 184, 197;
        --tz-body-bg: #2d333c;
        --tz-body-bg-rgb: 45, 51, 60;
        --tz-emphasis-color: #f8f9fa;
        --tz-emphasis-color-rgb: 248, 249, 250;
        --tz-secondary-color: #8391a2;
        --tz-secondary-color-rgb: 131, 145, 162;
        --tz-secondary-bg: #313a46;
        --tz-secondary-bg-rgb: 49, 58, 70;
        --tz-tertiary-color: #f1f1f1;
        --tz-tertiary-color-rgb: 241, 241, 241;
        --tz-tertiary-bg: #404954;
        --tz-tertiary-bg-rgb: 64, 73, 84;
        --tz-primary-text-emphasis: #35adb0;
        --tz-secondary-text-emphasis: #6c757d;
        --tz-success-text-emphasis: #3d7bcd;
        --tz-info-text-emphasis: #2e9eca;
        --tz-warning-text-emphasis: #d5b34d;
        --tz-danger-text-emphasis: #bb3939;
        --tz-pink-text-emphasis: #da4770;
        --tz-purple-text-emphasis: #66619e;
        --tz-light-text-emphasis: #6c757d;
        --tz-dark-text-emphasis: #6c757d;
        --tz-primary-bg-subtle: rgba(var(--tz-primary-rgb), 0.2);
        --tz-secondary-bg-subtle: rgba(var(--tz-secondary-rgb), 0.2);
        --tz-success-bg-subtle: rgba(var(--tz-success-rgb), 0.2);
        --tz-info-bg-subtle: rgba(var(--tz-info-rgb), 0.2);
        --tz-warning-bg-subtle: rgba(var(--tz-warning-rgb), 0.2);
        --tz-danger-bg-subtle: rgba(var(--tz-danger-rgb), 0.2);
        --tz-pink-bg-subtle: rgba(var(--tz-pink-rgb), 0.2);
        --tz-purple-bg-subtle: rgba(var(--tz-purple-rgb), 0.2);
        --tz-light-bg-subtle: rgba(var(--tz-light-rgb), 0.2);
        --tz-dark-bg-subtle: rgba(var(--tz-dark-rgb), 0.2);
        --tz-primary-border-subtle: #237375;
        --tz-secondary-border-subtle: #495057;
        --tz-success-border-subtle: #295289;
        --tz-info-border-subtle: #14465a;
        --tz-warning-border-subtle: #5f5022;
        --tz-danger-border-subtle: #7d2626;
        --tz-pink-border-subtle: #912f4a;
        --tz-purple-border-subtle: #44416a;
        --tz-light-border-subtle: #495057;
        --tz-dark-border-subtle: #36404c;
        --tz-heading-color: inherit;
        --tz-link-color: {{ $setting->primary_color }};
        --tz-link-hover-color: #35adb0;
        --tz-link-color-rgb: 59, 192, 195;
        --tz-link-hover-color-rgb: 53, 173, 176;
        --tz-code-color: {{ $setting->primary_color }};
        --tz-border-color: #464f5b;
        --tz-border-color-translucent: #464f5b;
        --tz-form-valid-color: #8fb8ef;
        --tz-form-valid-border-color: #8fb8ef;
        --tz-form-invalid-color: #e38c8c;
        --tz-form-invalid-border-color: #e38c8c;
    }
</style>
