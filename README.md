Legacy code example
=====

This is a simple Drupal module not meant to be used or useful, but only to demonstrate a technique to modify legacy code.

The code is meant to be horrible and reproduce something you may inherit in a real-world setting.

See also the [accompanying presentation](https://alberto56.github.io/presentation_legacy_code) which was given on June 18th 2016 at Drupal North in Montreal.

This module fetches GitHub repos via the GitHub API for a given user and displays them.

Requirements
-----

Docker.

Installation
-----

(1) Run the following:

    ./scripts/dev.sh

This will give you a one-time login link to a local Drupal site. (The IP address assumes you are running Docker in a [CoreOS Vagrant box on Mac](https://coreos.com/os/docs/latest/booting-on-vagrant.html); change it for your own IP address if you are running docker in another way.

(2) Create two nodes, "drupal", and "alberto56" (or another GitHub username).

(3) Visit any one of these nodes and click on the "List of repos for this project" tab, it will display repos for the user.

Branches
-----

### The master branch

Untested, untestable legacy code. This will display all repos for a given user.

Imagine you are tasked with limiting the repos to five, and displaying a message if there are more.

The following branches are different approaches to this:

### [Branch 1](https://github.com/alberto56/legacy_code_example/tree/1) (see also [issue #1](https://github.com/alberto56/legacy_code_example/issues/1))

This is what I would call the "bad way": simply adding code to an existing monster untested, untestable legacy function.

### [Branch 2](https://github.com/alberto56/legacy_code_example/tree/2) (see also [issue #2](https://github.com/alberto56/legacy_code_example/issues/2))

This branch moves procedural code to a class, adds a pure function to trim the number of repos, along with a corresponding automated test integrated with the Travis CI system.

This branch does not display a message to the user using `drupal_set_message()`, so the feature is incomplete at this point.

To run the test on this branch, run `./scripts/unit-tests.sh`.

The result from the CI server:

[![Build Status](https://travis-ci.org/alberto56/legacy_code_example.svg?branch=2)](https://travis-ci.org/alberto56/legacy_code_example)

### [Branch 3](https://github.com/alberto56/legacy_code_example/tree/3) (see also [issue #3](https://github.com/alberto56/legacy_code_example/issues/3))

This branch builds on branch 2, adding a mockable version of `drupal_set_message()`, and a mock subclass which overrides it.

The result from the CI server:

[![Build Status](https://travis-ci.org/alberto56/legacy_code_example.svg?branch=3)](https://travis-ci.org/alberto56/legacy_code_example)

### [Branch 4](https://github.com/alberto56/legacy_code_example/tree/4) (see also [issue #4](https://github.com/alberto56/legacy_code_example/issues/4))

This branch builds on branch 3, using PHPUnit to build a mock object on the fly rather than creating it ourselves.

The result from the CI server:

[![Build Status](https://travis-ci.org/alberto56/legacy_code_example.svg?branch=4)](https://travis-ci.org/alberto56/legacy_code_example)
