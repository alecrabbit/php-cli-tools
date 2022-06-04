# include .env # for environment variables

PROJECT_NAME=project.name

# DO NOT EDIT! See _VAR_FILE variable
# Git related variables
WORKING_BRANCH=dev
DEFAULT_COMMIT_MESSAGE=~wp

# Docker compose files

# _FILES = -f ${_DOCKER_COMPOSE_FILE} -f docker-compose.override.${_DC_EXTENSION}
_FILES = -f ${_DOCKER_COMPOSE_FILE}

# # -----------------------------------------------------------------------------

APP_CONTAINER=app
APP_PROJECT_NAME=${PROJECT_NAME}
