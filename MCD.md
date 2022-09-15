# MCD O'Story book

USER: nickname, _email, password, role
    ILLUSTRATE, 01 USER, 0N IMAGE
IMAGE: name, url
LOCATION: name, description, image
    REPRESENT, 11 CHARACTER, 11 IMAGE
CHARACTER: name, description
    BELONG, 1N LOCATION, 11 CHAPTER
    INSERT, 1N CHARACTER, 11 CHAPTER
CHAPTER: id, title, content
    HAS, 1N STORY, 11 CHAPTER
STORY: title, content, image, status, slug
  INCLUDE, 1N ACTION, 11 CHAPTER
ACTION: name
