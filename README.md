# WP Components

A collection of reusable web components for WordPress, designed to streamline development and maintain consistency across projects.

## Description

WP Components is a WordPress plugin that provides a set of reusable web components and Elementor widgets, making it easier to create consistent and maintainable WordPress websites. The plugin follows modern web development practices and integrates seamlessly with WordPress and Elementor.

## Features

### Web Components
- **Hero Component**: Multiple layout variants for hero sections
- **Button Component**: Customizable buttons with various styles
- **Card Component**: Flexible card layouts for content display
- **Alert Component**: Different types of alert messages
- **Badge Component**: Status and label indicators
- **Avatar Component**: User profile image display
- **Chip Component**: Compact information display
- **Form Component**: Custom form elements
- **Grid Component**: Responsive grid layouts
- **Modal Component**: Popup dialog boxes
- **Pagination Component**: Navigation for content lists
- **Tabs Component**: Tabbed content organization

### Elementor Integration
- Custom widgets for all components
- Drag-and-drop interface
- Live preview
- Responsive controls
- Style customization options

### Development Features
- Storybook integration for component documentation
- SCSS support for styling
- Modern JavaScript with Web Components
- TypeScript support
- Development tools and utilities

## Installation

1. Download the plugin zip file
2. Go to WordPress admin > Plugins > Add New
3. Click "Upload Plugin" and select the downloaded file
4. Click "Install Now" and then "Activate"

## Requirements

- WordPress 5.8 or higher
- PHP 7.4 or higher
- Elementor (optional, for widget support)
- Modern web browser with Web Components support

## Directory Structure

```
wp-components/
├── admin/                 # Admin interface files
├── assets/               # Static assets (JS, CSS, images)
├── includes/             # Core plugin files
│   ├── components/       # Individual component classes
│   ├── functions/        # Helper functions
│   ├── integrations/     # Third-party integrations
│   └── wp-components-functions.php
├── public/              # Public-facing files
│   ├── css/            # Compiled CSS
│   ├── js/             # Compiled JavaScript
│   └── storybook/      # Storybook documentation
└── wp-components.php    # Main plugin file
```

## Usage

### Basic Usage
```php
// Using a component in your theme
echo wp_component_button([
    'text' => 'Click Me',
    'variant' => 'primary',
    'url' => 'https://example.com'
]);

// Using a component in a template
echo wp_component_card([
    'title' => 'Card Title',
    'content' => 'Card content goes here',
    'image' => 'path/to/image.jpg'
]);
```

### Elementor Usage
1. Edit a page with Elementor
2. Find the "WP Components" category in the widget panel
3. Drag and drop any component widget
4. Configure the component settings in the Elementor panel

## Development

### Setup Development Environment
```bash
# Install dependencies
npm install

# Start development server
npm run dev

# Build for production
npm run build

# Run Storybook
npm run storybook
```

### Adding New Components
1. Create a new component class in `includes/components/`
2. Add component styles in `assets/scss/components/`
3. Create component JavaScript in `assets/js/components/`
4. Add Elementor widget in `includes/integrations/elementor/`
5. Create Storybook stories in `public/storybook/stories/`

## Documentation

- [Component Documentation](public/storybook)
- [API Reference](docs/api.md)
- [Development Guide](docs/development.md)
- [Contributing Guide](CONTRIBUTING.md)

## Contributing

We welcome contributions! Please see our [Contributing Guide](CONTRIBUTING.md) for details.

1. Fork the repository
2. Create your feature branch
3. Commit your changes
4. Push to the branch
5. Create a new Pull Request

## Support

- [GitHub Issues](https://github.com/ThoughtLabDev/wp-components/issues)
- [Documentation](https://github.com/ThoughtLabDev/wp-components/wiki)
- [Community Forum](https://github.com/ThoughtLabDev/wp-components/discussions)

## License

This plugin is licensed under the GPL v2 or later.

## Credits

- Built with [Web Components](https://developer.mozilla.org/en-US/docs/Web/Web_Components)
- Powered by [Elementor](https://elementor.com/)
- Documentation with [Storybook](https://storybook.js.org/) 