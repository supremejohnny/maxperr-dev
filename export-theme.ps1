$ErrorActionPreference = "Stop"

$themeName = "maxperr-dev"        # 你的主题目录名（与 style.css Text Domain 最好一致）
$srcDir    = "."                  # 本地主题根
$exportDir = "./theme-export"
$zipName   = "$themeName.zip"

# 1) 清理导出目录
if (Test-Path $exportDir) { Remove-Item -Recurse -Force $exportDir }
New-Item -ItemType Directory -Path $exportDir | Out-Null
$destRoot = Join-Path $exportDir $themeName
New-Item -ItemType Directory -Path $destRoot | Out-Null

# 2) 你要随包带走的目录/文件（按你的项目调整）
$includeDirs = @("assets","dist","inc","parts","patterns","templates","src")
$includeFiles = @("style.css","index.php","functions.php","header.php","footer.php",
  "front-page.php","page-landing-demo.php","partnership.php","products.php",
  "screenshot.png","theme.json","readme.txt","license.txt","README.md")

# 3) 拷贝白名单
foreach ($d in $includeDirs) {
  $p = Join-Path $srcDir $d
  if (Test-Path $p) {
    Copy-Item $p -Destination $destRoot -Recurse -Force
  }
}
foreach ($f in $includeFiles) {
  $p = Join-Path $srcDir $f
  if (Test-Path $p) {
    Copy-Item $p -Destination $destRoot -Force
  }
}

# 4) 删除垃圾与机密（按需增减）
$junk = @(
  "node_modules","vendor","*.map",".git",".github",".gitignore",
  ".env",".env.*","*.code-workspace",".vscode","logs","*.log",
  "composer.*","package.json","package-lock.json","pnpm-lock.yaml","yarn.lock",
  "postcss.config.cjs","tailwind.config.cjs","REPORT.md","ROUTING_UPDATE.md",
  ".DS_Store","Thumbs.db"
)
foreach ($pattern in $junk) {
  Get-ChildItem -Path $destRoot -Recurse -Force -ErrorAction SilentlyContinue -Filter $pattern |
    ForEach-Object { Remove-Item $_.FullName -Recurse -Force -ErrorAction SilentlyContinue }
}

# 5) 校验必需文件
$must = @("style.css","index.php")
foreach ($m in $must) {
  if (-not (Test-Path (Join-Path $destRoot $m))) {
    throw "缺少必需文件: $m"
  }
}

# 6) 压缩为 zip（顶层即 $themeName/）
if (Test-Path $zipName) { Remove-Item $zipName -Force }
Compress-Archive -Path (Join-Path $exportDir "*") -DestinationPath $zipName

Write-Host "✅ 导出完成: $zipName" -ForegroundColor Green
