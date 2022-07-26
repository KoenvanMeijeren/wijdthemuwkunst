**Wijdt Hem uw kunst**

This is the repository for the website Wijdt Hem uw kunst.

# Installation
The following steps should be executed in order to
install the application.
1. composer install
2. vendor/bin/generate-defuse-key
3. composer start
4. import the database

## Theme
The theme of the application is installed with Node
14.20.0.

### Site
```shell
cd public_html/themes/whuk_theme
npm install
npm run build
```

### Admin
```shell
cd public_html/themes/cms_theme
npm install
npm run build
```
