<?php

$dir = __DIR__ . '/app/Filament/Resources';
$files = glob($dir . '/*.php');

foreach ($files as $file) {
    if (is_file($file)) {
        $content = file_get_contents($file);
        
        // Find existing navigationGroup
        if (preg_match('/protected\s+static\s+(?:string\|\\\\UnitEnum\|null|\?string)\s+\$navigationGroup\s*=\s*(.+?);/', $content, $matches1)) {
            $groupValue = $matches1[1];
            $content = str_replace($matches1[0], '', $content);
            
            // Insert method before form()
            $method = "\n    public static function getNavigationGroup(): ?string\n    {\n        return " . $groupValue . ";\n    }\n\n";
            $content = preg_replace('/(public static function form\(Form \$form\))/', $method . '$1', $content, 1);
        }
        
        // Find existing navigationIcon
        if (preg_match('/protected\s+static\s+(?:string\|\\\\UnitEnum\|null|\?string|string\|\\\\BackedEnum\|null)\s+\$navigationIcon\s*=\s*(.+?);/', $content, $matches2)) {
            $iconValue = $matches2[1];
            $content = str_replace($matches2[0], '', $content);
            
            // Insert method before form()
            $method = "    public static function getNavigationIcon(): ?string\n    {\n        return " . $iconValue . ";\n    }\n\n";
            $content = preg_replace('/(public static function form\(Form \$form\))/', $method . '$1', $content, 1);
        }
        
        file_put_contents($file, $content);
        echo "Updated $file using getter methods\n";
    }
}
