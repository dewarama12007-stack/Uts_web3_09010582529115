$imgDir = "public/images"
if (!(Test-Path $imgDir)) {
    New-Item -ItemType Directory -Path $imgDir | Out-Null
}

$imgUrl = "https://lh3.googleusercontent.com/aida/AEtjO1Wf2NUx17kgfbi_Zn8sBeos0afDaRf-rkTbCSYA5p_I6pTI00sYB_UbuRKfEEyqpwZj61x9Za4OHQY61Se2qYf8E6QGWXoFFEV3Yl5tEFGbodePyxz1i0y0-PYK4kr2u0ZS-yYtLpNHb3fQGlXir_UlrdYg42RZm8UhEFvusSGfxuOFw8O93KGNwEsDhsT4Ol6p0wfmKhKDJH5-3pr4_zXg5q_oocGMOB_k5bxiPBvt6iOgCptj9SatwQ"
$svgUrl = "https://contribution.usercontent.google.com/download?c=CgthaWRhX2NvZGVmeBJ6Eh1hcHBfY29tcGFuaW9uX2dlbmVyYXRlZF9maWxlcxpZCiVodG1sXzAwMDY1ZDI1NGYyOWZiYTgwNGVhYWI3ZjhmMGQ3NDNhEgsSBxCfg-jeuAkYAZIBIgoKcHJvamVjdF9pZBIUQhIzMjgzMzk5OTk5MDk0ODg0ODg&filename=&opi=89354086"

curl.exe -L -s -o "public/images/logo.png" $imgUrl
curl.exe -L -s -o "stitch_designs/logo.png" $imgUrl
curl.exe -L -s -o "public/images/logo.svg" $svgUrl
curl.exe -L -s -o "stitch_designs/logo.svg" $svgUrl

Write-Host "Logo downloaded successfully!"
Get-Item "public/images/logo.png", "public/images/logo.svg" | Select-Object Name, Length
