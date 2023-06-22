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

## Documentation
Refer to the documentation for detailed usage instructions and code samples.

In a Laravel application, there are two common methods for uploading media files:

    Moving File Directly to the Public Folder:

   

>>$request->image->move(public_path('/images'), 'name.jpg');
>>
>>MedfiaFile::create(["path" => "images/name.jpg"]);

This approach involves moving the file directly to the public folder of your application using the $request->image->move() method. After moving the file, you can create a new record in the MediaFile model (assuming such a model exists) and store the file path.


    Using the Filesystem:


>>>$path = $request->file('image')->store('images');
>>>// or
>>>$path = Storage::disk('public')->putFile('images', $image);
>>>MedfiaFile::create(["path" => $path]);

Laravel provides a filesystem API for file storage, which offers convenience and flexibility. You can use the $request->file()->store() method or the Storage::disk()->putFile() method to upload the file to the desired directory. After storing the file, you can create a new record in the MediaFile model and store the returned file path.

Please note that you should adjust the file paths and model names to match your specific application structure. Also, ensure that you handle any necessary validations or security measures when implementing file uploads in your Laravel application.

In Mediasignature, there are two common methods for wrapping media files. Here's a more formal description of each method:

    Using Default Configuration:

    

>>$file = MediaFile::find($id);
>>return Mediasignature::wrap($file->path);

This approach utilizes the default configuration specified in the config/mediasignature.php file. The wrap() method is called with the file path as the parameter, and it returns a wrapped version of the file path (url).

    Using Custom Configuration:



>>$file = MediaFile::find($id);
>>return Mediasignature::wrap($file->path, $ttl, $filesystem, $disk);

In this method, you can specify custom configuration options for wrapping the file:
        $ttl (integer/nullable): Sets the time-to-live in minutes, indicating the duration for which the wrapped file will be accessible.
        $filesystem (boolean/nullable): Set to false if you used the first method to upload media directly, and true if you used the filesystem.
        $disk (enum [local or public]/nullable): Specify the disk to be used if you used the filesystem option.

This method allows you to override the default configuration for a specific file. By providing custom values for $ttl, $filesystem, and $disk, you can control the wrapping behavior according to your requirements.

Additionally, you can use the Mediasignature::wrapForMultiple() method to  wrap multiple files at once:

>>Mediasignature::wrapForMultiple($array_path)
>>Mediasignature::wrapForMultiple($array_path, $ttl, $filesystem, $disk)

These methods accept an array of file paths ($array_path) as the first parameter and provide options for customizing the wrapping process similar to the individual file wrapping method.

Please ensure that you provide appropriate values for the parameters and follow the documentation for proper usage of the Mediasignature package.


## Contributing

We welcome contributions to Mediasignature! If you would like to contribute, please follow these steps:

1. Fork the repository.
2. Create a new branch: `git checkout -b feature/your-feature`
3. Make your changes and commit them: `git commit -am 'Add your feature'`
4. Push to the branch: `git push origin feature/your-feature`
5. Submit a pull request.

Please ensure that your code follows the project's coding conventions and includes appropriate tests.
