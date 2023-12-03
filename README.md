# AdventOfCode by Monxu

## Technologies Used

- PHP 8.2
- Docker
## To Start

To get started with the project, follow these steps:

1. Make a copy of the `.env.dist` file and rename it to `.env`
2. Then you have to add the session value from AdventOfCode (https://adventofcode.com/) to the `.env` file, `SESSION_COOKIE` variable. You can find it in the cookies of the AdventOfCode website. The name of the cookie is `session`.
3. You need to have Docker running in your laptop. If not, you can install it
   from: https://www.docker.com/products/docker-desktop/
4. Once your Docker is running, you have two options:
    1. Start the application with: `make start`. This command will start the Docker containers and install the dependecies inside the docker container
5. To execute the scipts and use the debug, you have to access to the shell mode: `make shell` and then run `php src/YEAR/DayX/scriptName.php
6. Also, you can have a look all the solutions in the browser. You have to access to the url: http://localhost:8080/
7. Once you are done, you can stop and remove the Docker containers with: `make down` or if you want to keep them, you
   can do it with: `make stop`

## The Makefile

The project includes a Makefile with the following options:

- `start`: Starts the Docker containers in the background (no rebuild) and install the project dependencies inside the Docker container.
- `stop`: Stops the Docker containers.
- `down`: Stops and removes the Docker containers.
- `install`: Installs project dependencies inside the Docker container.
- `shell`: Access into the apache container.
- `help`: Shows a list with all available options and their descriptions.

Please refer to the Makefile for more details on each option.
