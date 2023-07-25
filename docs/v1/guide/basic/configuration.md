# Basic configuration

Publish the configuration for customization
```bash
php artisan vendor:publish --provider="Yormy\AnonymizerLaravel\AnonymizerLaravelServiceProvider" --tag="config"
```

### Environments
Specify the environments where you allow the anonymizer to run.
Standard only allowd to run on
* Local
* Test

### Default Locale
Specify the default locale to generate fake data

### Truncate
Sometimes you want to completely remove the contents of certain tables. Specify them in the trucate area
Ie. The audits table is something you generally want to delete

### Scan path
Specify where the anonymizer models live.
This path is scanned recursively to find models to handle the actual anonymizing

