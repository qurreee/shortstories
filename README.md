## How to clone and run!

<ol>
    <li>Clone or download the project repository.</li>
    <li>Unzip the downloaded file if necessary.</li>
    <li>Navigate to the project directory in the command line interface (CLI) using the <code>cd</code> command.</li>
    <li>Run <code>composer install</code> or <code>composer update</code> to install the project dependencies.</li>
    <li>Rename the <code>.env.example</code> file to <code>.env</code>.</li>
    <li>Set up the <code>.env</code> file with appropriate configurations, such as the database name,database connection (mysql) and root password.</li>
    <li>Generate an application key by running <code>php artisan key:generate</code>.</li>
    <li>Create a symbolic link from the public storage directory to the storage directory by running <code>php artisan storage:link</code>.</li>
    <li>Run database migrations using <code>php artisan migrate</code>.</li>
    <li>Seed the database with test data using <code>php artisan db:seed</code>.</li>
    <li>Start your XAMPP Apache and MySQL</li>
    <li>Open terminal and run <code>npm run dev</code> so the Tailwind css and Flowbite can run</li>
    <li>Either run <code>php artisan serve</code>, or setup the host and vhost on your device</li>
</ol>

