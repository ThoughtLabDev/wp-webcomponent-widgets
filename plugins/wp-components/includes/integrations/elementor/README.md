# Hero Web Component for Elementor

## Description
The Hero Web Component is a custom widget for Elementor that implements a reusable hero component with multiple layout variants and customization options.

## Features
- Multiple layout variants
- Image and video support
- Customizable CTAs
- Light/dark theme options
- Form integration
- Responsive
- Elementor compatible

## Available Variants
1. **Split** - Split layout with content and media side by side
2. **VideoSplit** - Similar to Split, but optimized for videos
3. **Centered** - Centered layout with media below content
4. **FeatureSplit** - Split layout with feature highlights
5. **AccentedSplit** - Split layout with accent images
6. **FullBackground** - Full-screen background image layout

## Settings

### Layout
- **Variant**: Layout type selection
- **Dark Background**: Toggle dark theme
- **Light Text**: Toggle between light and dark text
- **Force Mobile Layout**: Mobile preview option

### Content
- **Heading**: Main hero text
- **Subheading**: Secondary text (not available in some variants)
- **Primary Button**: Main CTA text and URL
- **Secondary Button**: Secondary CTA text and URL

### Media
- **Background Image**: For FullBackground variant
- **Main Media**: Main image/video
- **Alt Text**: Media description
- **Additional Images**: For AccentedSplit variant

### Forms
- **Donation Form**: Option to display donation form
- **Lead Gen Form**: Option to display lead capture form

### Styles
- **Heading Typography**: Title font customization
- **Subheading Typography**: Subtitle font customization
- **Custom CSS Class**: Add custom CSS classes

## Usage

### In Elementor
1. Drag the "Hero Web Component" widget to your page
2. Configure desired options in the tabs:
   - Layout
   - Content
   - Media
   - Forms
   - Styles

### Code Example
```php
// Component rendering
echo '<wycliffe-hero 
    heading="Hero Title"
    subheading="Hero Subtitle"
    variant="Split"
    media-url="image-url"
    cta-text="Primary Button"
    cta-url="button-url"
></wycliffe-hero>';
```

## Requirements
- WordPress
- Elementor
- WP Components Plugin
- Web Components enabled in browser

## Dependencies
- React
- ReactDOM
- Web Components API

## Debug
The component includes a debug mode that can be activated by setting `WP_DEBUG` to `true`. This will display information about the loading of required scripts.

## Contributing
To contribute to the development of this component:
1. Fork the repository
2. Create a feature branch
3. Commit your changes
4. Submit a pull request

## License
This component is part of the WP Components plugin and is under the same license. 