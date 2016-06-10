# AnimalServicesAPI
A Laravel-based API for Buddi, an Android app for City of Toronto: Animal Services

The goal is to create a REST API that the <a href="https://github.com/abhay-vaidya/Buddi">companion Android app</a> can interact with through CRUD (Create, Read, Update, Delete) operations.

The API user will have access to the following features depending on their token permissions:
* View animals and their attributes by ID
* Create/Edit animals (administrator)
* View a user's profile (authenticated user, limited access for non-authenticated users)
* Create/Edit user profiles (authenticated user)
* View animals matched to a user (authenticated user)
