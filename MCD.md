# MCD O'Story book

LOCATION: id, name, description, image
    CONTAIN, 1N LOCATION, 1N STORY
USER: id, nickname, email, password, role
    ILLUSTRATE, 01 USER, 0N IMAGE
STORY: id, title, content, image, status, slug
  OWN, 1N CHARACTER, 0N STORY
IMAGE: id, name, url
  ALLOW, 1N ACTION, 1N STORY
CHARACTER: id, name, description
    REPRESENT, 11 CHARACTER, 11 IMAGE
ACTION: id, name
