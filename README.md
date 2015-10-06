# wpaustin.com

*Note: This repository suggests using __[Varying-Vagrant-Vagrants](https://github.com/Varying-Vagrant-Vagrants/VVV)__ as a development environment. This documentation is written with that in mind.*

## Contributing
Be sure to view the GitHub wiki on how to format commit messages and other processes when contributing to this repository.

### Branching

master -> code on production server

dev -> code on staging server

other branches -> work on new development features

### Workflow

1. Branch off of dev to create your feature branch
2. Develop your new feature
3. Create a pull request into the dev branch.
4. Ideally, this will get a code review by another member of the community
5. Merge into staging, and then push to the staging server for testing
6. Once you are ready to launch, create a pull request into the master branch
7. Merge into master, and then push to the production server to launch the new feature
