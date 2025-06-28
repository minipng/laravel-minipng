# Contributing to Laravel MiniPNG Package

Thank you for your interest in contributing to the Laravel MiniPNG Package! This document provides guidelines for contributing to this project.

## Code of Conduct

By participating in this project, you agree to abide by our Code of Conduct.

## How Can I Contribute?

### Reporting Bugs

- Use the GitHub issue tracker to report bugs
- Include detailed steps to reproduce the bug
- Include your PHP version, Laravel version, and package version
- Include any error messages or stack traces

### Suggesting Enhancements

- Use the GitHub issue tracker to suggest new features
- Describe the feature in detail
- Explain why this feature would be useful
- Include any mockups or examples if applicable

### Pull Requests

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Make your changes
4. Add tests for new functionality
5. Ensure all tests pass (`composer test`)
6. Commit your changes (`git commit -m 'Add some amazing feature'`)
7. Push to the branch (`git push origin feature/amazing-feature`)
8. Open a Pull Request

## Development Setup

1. Clone the repository:
```bash
git clone https://github.com/your-username/laravel-minipng.git
cd laravel-minipng
```

2. Install dependencies:
```bash
composer install
```

3. Copy the environment file:
```bash
cp env.example .env
```

4. Update the `.env` file with your MiniPNG API key:
```env
MINIPNG_API_KEY=your_api_key_here
```

5. Run tests:
```bash
composer test
```

## Coding Standards

- Follow PSR-12 coding standards
- Use type hints and return types where possible
- Write meaningful commit messages
- Add PHPDoc comments for all public methods
- Keep methods small and focused

## Testing

- Write tests for all new functionality
- Ensure existing tests continue to pass
- Aim for high test coverage
- Use descriptive test method names

## Documentation

- Update README.md if adding new features
- Add examples for new functionality
- Update CHANGELOG.md for all changes
- Keep inline documentation up to date

## Release Process

1. Update version in `composer.json`
2. Update `CHANGELOG.md` with new version
3. Create a git tag for the release
4. Push changes and tag to GitHub

## Questions?

If you have questions about contributing, please open an issue or contact us at info@minipng.com.

Thank you for contributing to Laravel MiniPNG Package! 