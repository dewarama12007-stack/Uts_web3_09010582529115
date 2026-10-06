$dir = "stitch_designs"
if (!(Test-Path $dir)) {
    New-Item -ItemType Directory -Path $dir | Out-Null
}

$screens = @(
    @{
        id = "135010138cd74d32a2f1fa6d3d9f497a"
        name = "01_login"
        img = "https://lh3.googleusercontent.com/aida/AEtjO1XnU91Ykojc7kqwen-eQBiShgE6JWGpdQBKkp_cNhtfr4NHxe_gconmZv919u4sYmcmsRXkuKC7R5H4c6Q5gVfRBiV7zf5s9nRH-kraqOgEkk7dFXrPwczh_DXpyQ-EoP-GGOWlpaWsmp4EsrCzBJ_qV9I2MMHGNtOCgxxztBfARpEGceGh9BfXoTqP2GPswGiW0IiTpccwXliqwiPCaB7Wp8dS6ITGL16SFDNNc7swQKGbpSLsD0e2DA"
        html = "https://contribution.usercontent.google.com/download?c=CgthaWRhX2NvZGVmeBJ6Eh1hcHBfY29tcGFuaW9uX2dlbmVyYXRlZF9maWxlcxpZCiVodG1sXzAwMDY1ZDI0ODliZDE3YzcwMjJkNGZhYWM5MzgxY2RhEgsSBxCfg-jeuAkYAZIBIgoKcHJvamVjdF9pZBIUQhIzMjgzMzk5OTk5MDk0ODg0ODg&filename=&opi=89354086"
    },
    @{
        id = "28cd5031f8f04ba28f65de4f4373baf1"
        name = "02_dashboard"
        img = "https://lh3.googleusercontent.com/aida/AEtjO1XOgdcvPdnyz9T5pqWsCpEqWX5_4qi-A5ZVSgKtYYKcN1OnW4OOCgNmvUFQrxdGR9VaRgw19TLdayJb--Rp7p3umJzXymyd1cIzlUO74NIAIdY2pPNrbgCp1lG4_a8ondNIKGVhdhJOUT9cCESZTNTLwPDgSGh621MV31fThog_J6qp6WhBwk5Pv8Cct0CedcrNOgbU_ruzRT2ybYrpATUd__o07WDnlz1JK6qyRc4laqSbInsou0Sv"
        html = "https://contribution.usercontent.google.com/download?c=CgthaWRhX2NvZGVmeBJ6Eh1hcHBfY29tcGFuaW9uX2dlbmVyYXRlZF9maWxlcxpZCiVodG1sXzAwMDY1ZDI0ODk1YmMyYWIwNzc5ODRhODIxMGU3OWI0EgsSBxCfg-jeuAkYAZIBIgoKcHJvamVjdF9pZBIUQhIzMjgzMzk5OTk5MDk0ODg0ODg&filename=&opi=89354086"
    },
    @{
        id = "5e5849c97ae14c9091e8b541068fac71"
        name = "03_daftar_buku"
        img = "https://lh3.googleusercontent.com/aida/AEtjO1W8msYse6nd0VDXgxScguo0vkd-IpesoJQkDB1qCeVvhASKHUyOBSoJDVVeyLoR5wt3orxd4SaSWcAL9T-WwlSPBgSr_ORyDTwM_uOHMZjoYSbCzX8s4MJsp7oOxpWKGkqJZ3mVIpQWOw-8ycxHfDFYEtCz-WRvgA0ElaF__DpJ1Zvk3W8PsNABUZ_EMX-6Ul8_yjUzcg9x2t6fXtSgDJOOX6aujJ5jkgbdRYD4aH8bQ9EJ4_lCBUD0"
        html = "https://contribution.usercontent.google.com/download?c=CgthaWRhX2NvZGVmeBJ6Eh1hcHBfY29tcGFuaW9uX2dlbmVyYXRlZF9maWxlcxpZCiVodG1sXzAwMDY1ZDI0ODk2YTBmYTUwMWE2MGI3YTRkMjU0ZTQ3EgsSBxCfg-jeuAkYAZIBIgoKcHJvamVjdF9pZBIUQhIzMjgzMzk5OTk5MDk0ODg0ODg&filename=&opi=89354086"
    },
    @{
        id = "b0e63f98625a4a6592fc6788b3b50d77"
        name = "04_tambah_buku"
        img = "https://lh3.googleusercontent.com/aida/AEtjO1VgS9Frm2Cgw2-4hBUF81NSHl79Omi__L3REHRfpYlfmQcBJgBWpXM3ybEac4hBxu-35aLZZTy0rHGWLGuN3RHgZvckJ0oAU4XFbZCZeJgAKW4G4O6cyFUo_n7AMuLSKbXV6Ky-6FBqYUzT31hoE25dD0sNoRnQyd-vhBolAlHwEqx1iFRXvoJEcnF5WuWYyD_1pAYkngz8-9UBwgIRuQ_YQtYpLpl7nusB8qsm5UBboTB-rqJJGDxUJw"
        html = "https://contribution.usercontent.google.com/download?c=CgthaWRhX2NvZGVmeBJ6Eh1hcHBfY29tcGFuaW9uX2dlbmVyYXRlZF9maWxlcxpZCiVodG1sXzAwMDY1ZDI0ODk0ZGRlNjEwNWMyZmY5NzZmMzQwNmE1EgsSBxCfg-jeuAkYAZIBIgoKcHJvamVjdF9pZBIUQhIzMjgzMzk5OTk5MDk0ODg0ODg&filename=&opi=89354086"
    },
    @{
        id = "eff39f430b034c96aa4c59f29e10c554"
        name = "05_detail_buku"
        img = "https://lh3.googleusercontent.com/aida/AEtjO1WzoVXoyO_WViInd7QElEad6bjEhz6jY6TMjDikG8jNwWtuQZKOpyynWP-BQXAZHnt5h7eckN9sZvA27lQKdTD0GPwHqo8Y2I9HsgOMafCub-EWRwlxxOy4czVYEF0vcOZyBBxAuDhMeUNb1AqzTuc9wFoeL41-S_G105YsH3_Opcc9axaulbMXxC6zxf59GahVmd35ey3UnMvl1jafTqk62qBkQov-8ogNvZefy3OO9W9QBbgdW21vxg"
        html = "https://contribution.usercontent.google.com/download?c=CgthaWRhX2NvZGVmeBJ6Eh1hcHBfY29tcGFuaW9uX2dlbmVyYXRlZF9maWxlcxpZCiVodG1sXzAwMDY1ZDI0ODlmNjc0OWIwNzNhY2YyM2RjMDA5NTE3EgsSBxCfg-jeuAkYAZIBIgoKcHJvamVjdF9pZBIUQhIzMjgzMzk5OTk5MDk0ODg0ODg&filename=&opi=89354086"
    },
    @{
        id = "507ee302027b49ff9c099b6378a25795"
        name = "06_edit_buku"
        img = "https://lh3.googleusercontent.com/aida/AEtjO1WMQubAp37VZ7tJyqIeAx5NlP7PFPyC62pcOSklNYbb-1HR2QgUXlJnUrJGY5hxghkZfdJ-tbiFA3p8WSa4n3y4yKjSIk6XLSJSIRHyAkLBngpkSQkX1p3oG66xdE1H8uf63Jj0BYBmTKkRowapQznKIIqx5S5F-StBF1xABWme2l5XnhMAFOz5bTvvFb9jVwf59GI3iK70khJWl9uNgBiytvJDsnTBSmpnEq23V7Kc_MUTXaccut_zBw"
        html = "https://contribution.usercontent.google.com/download?c=CgthaWRhX2NvZGVmeBJ6Eh1hcHBfY29tcGFuaW9uX2dlbmVyYXRlZF9maWxlcxpZCiVodG1sXzAwMDY1ZDI0OGEyZGRmZmYwMzM4NWE2MDI4MDgyNjBiEgsSBxCfg-jeuAkYAZIBIgoKcHJvamVjdF9pZBIUQhIzMjgzMzk5OTk5MDk0ODg0ODg&filename=&opi=89354086"
    }
)

foreach ($item in $screens) {
    $imgName = $item.name + ".png"
    $htmlName = $item.name + ".html"
    $imgPath = Join-Path $dir $imgName
    $htmlPath = Join-Path $dir $htmlName

    Write-Host "Downloading $($item.name) image..."
    curl.exe -L -s -o $imgPath $item.img

    Write-Host "Downloading $($item.name) html..."
    curl.exe -L -s -o $htmlPath $item.html
}

Write-Host "Finished downloading all 6 Stitch screens!"
