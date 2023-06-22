## Mediasignature

Mediasignature is a powerful package that provides secure tokenization and time-limited access control for images. It allows you to protect your images by generating unique tokens and controlling access to them within specified time limits.

## Features

- Image Tokenization: Generate unique and tamper-proof tokens for each image to ensure secure access.
- Time-Limited Access: Set expiration dates and times for image access, providing granular control over accessibility.
- Robust Security Measures: Utilize strong encryption algorithms to safeguard images and tokens from unauthorized access.
- Flexible Integration: Seamlessly integrate with existing image storage and retrieval systems.
- User-Friendly Interface: Easy-to-use interface for token generation, access management, and monitoring.
- Compliance and Privacy: Prioritize compliance with privacy laws and regulations to protect user data and sensitive images.

## Installation

To install Mediasignature, follow these steps:

1. Clone the repository: `composer require heddiyoussouf/mediasignature`.
2. Publish MediasigntureProvider: `php artisan vendor:publish --provider=Heddiyoussouf\Mediasignature\MediasignatureProvider`.
3. Check the `mediasignature` file inside the config folder.


## Getting Started

To start using Mediasignature, you need to perform the following steps:

1. Import the Mediasignature facade into your project: `Heddiyoussouf\Mediasignature\Facades\Mediasignature`.
2. Generate an url for an image `Mediasignature::wrap()`for single media file and `Mediasignature::wrapForMultiple()` for multiple file.

Refer to the documentation for detailed usage instructions and code samples.

## Contributing
