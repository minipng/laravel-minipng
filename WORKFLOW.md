# Development Workflow

This document outlines the development workflow for the Laravel MiniPNG Package.

## Getting Started

### Prerequisites
- PHP 8.0 or higher
- Composer
- Git
- MiniPNG API key

### Initial Setup

1. **Clone the repository**
   ```bash
   git clone https://github.com/your-username/laravel-minipng.git
   cd laravel-minipng
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Set up environment**
   ```bash
   cp env.example .env
   # Edit .env with your API key
   ```

4. **Run tests**
   ```bash
   composer test
   ```

## Development Process

### 1. Feature Development

1. **Create a feature branch**
   ```bash
   git checkout -b feature/your-feature-name
   ```

2. **Make your changes**
   - Follow PSR-12 coding standards
   - Add type hints and return types
   - Write meaningful commit messages
   - Add tests for new functionality

3. **Run tests**
   ```bash
   composer test
   composer test-coverage  # For coverage report
   ```

4. **Update documentation**
   - Update README.md if needed
   - Add examples for new features
   - Update CHANGELOG.md

### 2. Bug Fixes

1. **Create a bug fix branch**
   ```bash
   git checkout -b fix/issue-description
   ```

2. **Fix the issue**
   - Write a test that reproduces the bug
   - Fix the issue
   - Ensure all tests pass

3. **Update documentation**
   - Update CHANGELOG.md with fix details

### 3. Code Review Process

1. **Push your changes**
   ```bash
   git push origin your-branch-name
   ```

2. **Create a Pull Request**
   - Use the provided PR template
   - Include tests and documentation updates
   - Request review from maintainers

3. **Address feedback**
   - Respond to review comments
   - Make requested changes
   - Push updates to your branch

### 4. Release Process

1. **Update version**
   - Update version in `composer.json`
   - Update `CHANGELOG.md`

2. **Create release**
   ```bash
   git tag v1.0.0
   git push origin v1.0.0
   ```

3. **Publish to Packagist**
   - Create release on GitHub
   - Packagist will automatically update

## Testing Strategy

### Unit Tests
- Test all public methods
- Mock external API calls
- Test error scenarios
- Aim for >90% coverage

### Integration Tests
- Test with real API (in separate test suite)
- Test Laravel integration
- Test configuration loading

### Manual Testing
- Test with different Laravel versions
- Test with different PHP versions
- Test all API endpoints

## Code Quality

### Standards
- Follow PSR-12 coding standards
- Use PHP 8.0+ features where appropriate
- Add comprehensive PHPDoc comments
- Keep methods small and focused

### Tools
- PHPUnit for testing
- PHPStan for static analysis
- PHP CS Fixer for code formatting

### Pre-commit Checklist
- [ ] All tests pass
- [ ] Code follows PSR-12
- [ ] Documentation is updated
- [ ] CHANGELOG.md is updated
- [ ] No debugging code left

## Documentation

### Required Updates
- README.md for new features
- CHANGELOG.md for all changes
- Inline documentation for new methods
- Examples for new functionality

### Documentation Standards
- Clear and concise descriptions
- Code examples for all features
- Include error handling examples
- Keep examples up to date

## Release Checklist

### Before Release
- [ ] All tests pass
- [ ] Documentation is complete
- [ ] CHANGELOG.md is updated
- [ ] Version is updated in composer.json
- [ ] No breaking changes (or properly documented)

### Release Steps
1. Update version numbers
2. Update CHANGELOG.md
3. Create git tag
4. Push to GitHub
5. Create GitHub release
6. Update Packagist (if needed)

### Post-Release
- [ ] Monitor for issues
- [ ] Respond to user feedback
- [ ] Plan next release

## Support

### Issue Management
- Use GitHub issues for bug reports
- Use GitHub discussions for questions
- Respond within 24 hours
- Provide clear, helpful responses

### Community Guidelines
- Be respectful and helpful
- Provide constructive feedback
- Follow the Code of Conduct
- Encourage contributions

## Tools and Resources

### Development Tools
- **IDE**: PHPStorm, VS Code, or similar
- **Version Control**: Git
- **Package Manager**: Composer
- **Testing**: PHPUnit
- **CI/CD**: GitHub Actions

### Resources
- [Laravel Documentation](https://laravel.com/docs)
- [PHP Documentation](https://www.php.net/docs.php)
- [PSR Standards](https://www.php-fig.org/psr/)
- [Composer Documentation](https://getcomposer.org/doc/)

## Questions?

If you have questions about the development workflow, please:
1. Check the documentation
2. Search existing issues
3. Create a new issue
4. Contact the maintainers at info@minipng.com 