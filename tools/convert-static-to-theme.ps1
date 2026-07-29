param(
    [string] $ProjectRoot = (Split-Path -Parent $PSScriptRoot)
)

$ErrorActionPreference = 'Stop'

$themeRoot = Join-Path $ProjectRoot 'theme\buybuycoms-hobby'
$templatePartRoot = Join-Path $themeRoot 'template-parts'
$pageScriptRoot = Join-Path $themeRoot 'asset\js\pages'

New-Item -ItemType Directory -Force -Path $themeRoot | Out-Null
New-Item -ItemType Directory -Force -Path (Join-Path $templatePartRoot 'common') | Out-Null
New-Item -ItemType Directory -Force -Path (Join-Path $templatePartRoot 'content') | Out-Null
New-Item -ItemType Directory -Force -Path $pageScriptRoot | Out-Null
New-Item -ItemType Directory -Force -Path (Join-Path $themeRoot 'asset\css') | Out-Null
New-Item -ItemType Directory -Force -Path (Join-Path $themeRoot 'asset\js') | Out-Null

Copy-Item -LiteralPath (Join-Path $ProjectRoot 'asset\css\tokens.css') -Destination (Join-Path $themeRoot 'asset\css\tokens.css') -Force
Copy-Item -LiteralPath (Join-Path $ProjectRoot 'asset\css\reset.css') -Destination (Join-Path $themeRoot 'asset\css\reset.css') -Force
Copy-Item -LiteralPath (Join-Path $ProjectRoot 'asset\css\base.css') -Destination (Join-Path $themeRoot 'asset\css\base.css') -Force
Copy-Item -LiteralPath (Join-Path $ProjectRoot 'asset\css\utility.css') -Destination (Join-Path $themeRoot 'asset\css\utility.css') -Force
Copy-Item -LiteralPath (Join-Path $ProjectRoot 'asset\css\component.css') -Destination (Join-Path $themeRoot 'asset\css\component.css') -Force
Copy-Item -LiteralPath (Join-Path $ProjectRoot 'asset\css\page.css') -Destination (Join-Path $themeRoot 'asset\css\page.css') -Force
Copy-Item -LiteralPath (Join-Path $ProjectRoot 'asset\js\component.js') -Destination (Join-Path $themeRoot 'asset\js\component.js') -Force
Copy-Item -LiteralPath (Join-Path $ProjectRoot 'asset\image') -Destination (Join-Path $themeRoot 'asset') -Recurse -Force
Copy-Item -LiteralPath (Join-Path $ProjectRoot 'images') -Destination $themeRoot -Recurse -Force

$componentMap = @{
    'blog-card'            = 'content/blog-card'
    'customer-reviews'     = 'common/customer-reviews'
    'flow-tab'             = 'common/flow-tab'
    'footer-cta'           = 'common/footer-cta'
    'genre-table'          = 'common/genre-table'
    'parts-cta'            = 'common/parts-cta'
    'purchase-cases'       = 'common/purchase-cases'
    'purchase-methods'     = 'common/purchase-methods'
    'purchase-price-table' = 'common/purchase-price-table'
}

$pageMap = [ordered]@{
    'front.html'                   = 'front-page.php'
    'page-flow.html'               = 'page-flow.php'
    'page-genre-list.html'         = 'page-genre-list.php'
    'page-faq.html'                = 'page-faq.php'
    'page-company.html'            = 'page-company.php'
    'page-reason.html'             = 'page-reason.php'
    'page-contact.html'            = 'page-contact.php'
    'page-privacy.html'            = 'page-privacy.php'
    'archive-purchase-record.html' = 'archive-purchase-record.php'
    'single-purchase-record.html'  = 'single-purchase-record.php'
    'archive-info.html'            = 'home.php'
    'single-info.html'             = 'single.php'
    'archive-column.html'          = 'archive-column.php'
    'single-column.html'           = 'single-column.php'
    'taxonomy-genre.html'          = 'taxonomy-genre.php'
}

$pageTemplateNames = @{
    'page-flow.php'       = 'Purchase Flow'
    'page-genre-list.php' = 'Genre List'
    'page-faq.php'        = 'FAQ'
    'page-company.php'    = 'Company'
    'page-reason.php'     = 'Reasons'
    'page-contact.php'    = 'Contact'
    'page-privacy.php'    = 'Privacy Policy'
}

$pageFallbackRoutes = @{
    'front.html'                   = '/info/'
    'page-flow.html'               = '/contact/'
    'page-genre-list.html'         = '/genre-list/'
    'page-faq.html'                = '/faq/'
    'page-company.html'            = '/company/'
    'page-reason.html'             = '/contact/'
    'page-contact.html'            = '/contact/'
    'page-privacy.html'            = '/privacy/'
    'archive-purchase-record.html' = '/purchase-record/'
    'single-purchase-record.html'  = '/purchase-record/'
    'archive-info.html'            = '/info/'
    'single-info.html'             = '/info/'
    'archive-column.html'          = '/column/'
    'single-column.html'           = '/column/'
    'taxonomy-genre.html'          = '/genre-list/'
}

$componentFallbackRoutes = @{
    'blog-card'            = '/column/'
    'customer-reviews'     = '/contact/'
    'flow-tab'             = '/contact/'
    'footer-cta'           = '/contact/'
    'genre-table'          = '/genre-list/'
    'parts-cta'            = '/contact/'
    'purchase-cases'       = '/purchase-record/'
    'purchase-methods'     = '/flow/'
    'purchase-price-table' = '/purchase-record/'
}

function Convert-AssetUrls {
    param([string] $Markup)

    $assetAliases = @{
        'images/genre/mv-ganpura.webp' = 'images/genre/mv_gandamu.webp'
    }

    $result = [regex]::Replace(
        $Markup,
        '(?<attr>\b(?:src|poster))=(?<quote>["''])(?:\.\./)*(?<path>(?:asset|images)/[^"'']+)\k<quote>',
        {
            param($match)
            $relativePath = $match.Groups['path'].Value.Replace('\', '/')
            if ($assetAliases.ContainsKey($relativePath)) {
                $relativePath = $assetAliases[$relativePath]
            }
            $path = '/' + $relativePath
            return $match.Groups['attr'].Value + '="<?php echo esc_url( get_theme_file_uri( ''' + $path + ''' ) ); ?>"'
        },
        [Text.RegularExpressions.RegexOptions]::IgnoreCase
    )

    return $result
}

function Convert-StaticLinks {
    param([string] $Markup)

    $routes = @{
        'index.html'                   = '/'
        'front.html'                   = '/'
        'page-flow.html'               = '/flow/'
        'page-genre-list.html'         = '/genre-list/'
        'page-faq.html'                = '/faq/'
        'page-company.html'            = '/company/'
        'page-reason.html'             = '/reason/'
        'page-contact.html'            = '/contact/'
        'kaitori-form.html'             = '/contact/'
        'page-privacy.html'             = '/privacy/'
        'archive-purchase-record.html' = '/purchase-record/'
        'archive-info.html'            = '/info/'
        'archive-column.html'          = '/column/'
        'single-info.html'             = '/info/'
        'single-purchase-record.html'  = '/purchase-record/'
        'single-column.html'           = '/column/'
        'taxonomy-genre.html'          = '/genre-list/'
    }

    $result = $Markup

    foreach ($entry in $routes.GetEnumerator()) {
        $escaped = [regex]::Escape($entry.Key)
        $route = $entry.Value
        $result = [regex]::Replace(
            $result,
            'href=(?<quote>["''])(?:\.\./(?:pages/)?)?' + $escaped + '(?<suffix>[?#][^"'']*)?\k<quote>',
            {
                param($match)
                $url = $route + $match.Groups['suffix'].Value
                return 'href="<?php echo esc_url( home_url( ''' + $url + ''' ) ); ?>"'
            },
            [Text.RegularExpressions.RegexOptions]::IgnoreCase
        )
    }

    return $result
}

function Convert-Includes {
    param([string] $Markup)

    $result = [regex]::Replace(
        $Markup,
        '<div\b[^>]*data-hb-include=["''][^"'']*header\.html(?:\?[^"'']*)?["''][^>]*>\s*</div>',
        '<?php get_header(); ?>',
        [Text.RegularExpressions.RegexOptions]::IgnoreCase
    )
    $result = [regex]::Replace(
        $result,
        '<div\b[^>]*data-hb-include=["''][^"'']*footer\.html(?:\?[^"'']*)?["''][^>]*>\s*</div>',
        '<?php get_footer(); ?>',
        [Text.RegularExpressions.RegexOptions]::IgnoreCase
    )

    foreach ($entry in $componentMap.GetEnumerator()) {
        $name = [regex]::Escape($entry.Key)
        $part = $entry.Value
        $replacement = '<?php get_template_part( ''template-parts/' + $part + ''' ); ?>'
        $result = [regex]::Replace(
            $result,
            '<div\b[^>]*data-hb-include=["''][^"'']*' + $name + '\.html(?:\?[^"'']*)?["''][^>]*>\s*</div>',
            $replacement,
            [Text.RegularExpressions.RegexOptions]::IgnoreCase
        )
    }

    return $result
}

function Convert-Markup {
    param(
        [string] $Markup,
        [string] $FallbackRoute
    )

    $result = Convert-Includes -Markup $Markup
    $result = Convert-AssetUrls -Markup $result
    $result = Convert-StaticLinks -Markup $result
    if ($FallbackRoute) {
        $replacement = 'href="<?php echo esc_url( home_url( ''' + $FallbackRoute + ''' ) ); ?>"'
        $result = [regex]::Replace(
            $result,
            'href=["'']#["'']',
            $replacement,
            [Text.RegularExpressions.RegexOptions]::IgnoreCase
        )
    }
    return $result.Trim()
}

function Write-Utf8NoBom {
    param(
        [string] $Path,
        [string] $Content
    )

    [IO.File]::WriteAllText(
        $Path,
        $Content,
        [Text.UTF8Encoding]::new($false)
    )
}

$pageCss = New-Object Collections.Generic.List[string]

foreach ($entry in $componentMap.GetEnumerator()) {
    $sourcePath = Join-Path $ProjectRoot ('components\' + $entry.Key + '.html')
    $destinationPath = Join-Path $templatePartRoot ($entry.Value + '.php')
    $markup = Get-Content -LiteralPath $sourcePath -Raw -Encoding utf8
    $converted = Convert-Markup -Markup $markup -FallbackRoute $componentFallbackRoutes[$entry.Key]
    $header = "<?php`r`n/**`r`n * Static first-stage template part: $($entry.Key).`r`n *`r`n * @package BuyBuyComs_Hobby`r`n */`r`n?>`r`n"
    Write-Utf8NoBom -Path $destinationPath -Content ($header + $converted + "`r`n")
}

foreach ($entry in $pageMap.GetEnumerator()) {
    $sourcePath = Join-Path $ProjectRoot ('pages\' + $entry.Key)
    $destinationPath = Join-Path $themeRoot $entry.Value
    $document = Get-Content -LiteralPath $sourcePath -Raw -Encoding utf8

    $styleMatches = [regex]::Matches(
        $document,
        '<style\b[^>]*>(?<css>.*?)</style>',
        [Text.RegularExpressions.RegexOptions]::IgnoreCase -bor [Text.RegularExpressions.RegexOptions]::Singleline
    )
    foreach ($styleMatch in $styleMatches) {
        $pageCss.Add("`r`n/* Source: pages/$($entry.Key) */`r`n" + $styleMatch.Groups['css'].Value.Trim() + "`r`n")
    }

    $bodyMatch = [regex]::Match(
        $document,
        '<body\b[^>]*>(?<body>.*?)</body>',
        [Text.RegularExpressions.RegexOptions]::IgnoreCase -bor [Text.RegularExpressions.RegexOptions]::Singleline
    )
    if (-not $bodyMatch.Success) {
        throw "Body not found: $($entry.Key)"
    }

    $body = $bodyMatch.Groups['body'].Value
    $scripts = New-Object Collections.Generic.List[string]
    $body = [regex]::Replace(
        $body,
        '<script(?![^>]*\bsrc\s*=)[^>]*>(?<script>.*?)</script>',
        {
            param($match)
            $scripts.Add($match.Groups['script'].Value.Trim())
            return ''
        },
        [Text.RegularExpressions.RegexOptions]::IgnoreCase -bor [Text.RegularExpressions.RegexOptions]::Singleline
    )

    $converted = Convert-Markup -Markup $body -FallbackRoute $pageFallbackRoutes[$entry.Key]
    $converted = [regex]::Replace(
        $converted,
        '<main\b(?<attributes>[^>]*)>',
        {
            param($match)
            $attributes = [regex]::Replace(
                $match.Groups['attributes'].Value,
                '\s+id=["''][^"'']+["'']',
                '',
                [Text.RegularExpressions.RegexOptions]::IgnoreCase
            )
            return '<main id="main-content"' + $attributes + '>'
        },
        [Text.RegularExpressions.RegexOptions]::IgnoreCase,
        [TimeSpan]::FromSeconds(2)
    )
    $phpHeader = "<?php`r`n/**`r`n * Static first-stage template generated from pages/$($entry.Key).`r`n *`r`n * @package BuyBuyComs_Hobby`r`n */"
    if ($pageTemplateNames.ContainsKey($entry.Value)) {
        $phpHeader += "`r`n/*`r`nTemplate Name: $($pageTemplateNames[$entry.Value])`r`n*/"
    }
    $phpHeader += "`r`n?>`r`n"
    Write-Utf8NoBom -Path $destinationPath -Content ($phpHeader + $converted + "`r`n")

    if ($scripts.Count -gt 0) {
        $scriptName = [IO.Path]::GetFileNameWithoutExtension($entry.Value) + '.js'
        $scriptPath = Join-Path $pageScriptRoot $scriptName
        $scriptHeader = "'use strict';`r`n`r`n"
        Write-Utf8NoBom -Path $scriptPath -Content ($scriptHeader + ($scripts -join "`r`n`r`n") + "`r`n")
    }
}

$pageCssHeader = @'
/**
 * First-stage page styles extracted from the static reference HTML.
 *
 * These rules preserve visual parity while the static pages are converted to
 * WordPress templates. Consolidation into the source FLOCSS layers is deferred
 * until the Local visual-comparison pass.
 */
'@
Write-Utf8NoBom -Path (Join-Path $themeRoot 'asset\css\page-static.css') -Content ($pageCssHeader + ($pageCss -join ''))

Write-Output "Theme generated at: $themeRoot"
