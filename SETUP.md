### SETUP:

- Fill the .evn file with your personal data:
    - database credentials
    - APP_URL with your virtual host (APP_URL=http://abstracttest.test)
    - MAIL_HOST and other credentials to be able to receive emails (mailtrap.io, etc..)
        - GitHub API credentials:
            - You have to visit the [GitHub developers account](https://github.com/settings/developers) to get the GitHub client id and secret.
            - You have to create a new OAuth application, so create it on the `New GitHub App` button.
            - When you react to the next screen, fill in the required information to register a new OAuth app.
              Once the app is registered correctly, then you can get the Client ID and Secrets effortlessly.
            - GITHUB_CLIENT_ID=
            - GITHUB_CLIENT_SECRET=
            - GITHUB_REDIRECT=${APP_URL}/auth/github/callback
            - you can get idea if you take a look at .env.example


- Fill .env.testing with the data:
    - database credentials
    - set `test_database` as database name because that name is defined in phpunit.xml (or change both)
    - MAIL_HOST and other credentials same as in .env
    - you can get idea if you take a look at .env.testing.example



### How to use this app:

- Please run commands at the root of the project:
    - composer install
    - php artisan migrate
    - php artisan key:generate


- Go to a site (http://abstracttest.test) and you will see a login page with the big orange `Sign In With GitHub` button.
- Sing Up/Sign In with the click on the button and you will be redirected to a Profile page where you will see information about the user and company.
- On the sidebar left you will see another link `Repositories`, you can click on that and you will see the list of all the repositories.
- To see all commits for the repo, click the name of the repository which is the link to the commit details page.

