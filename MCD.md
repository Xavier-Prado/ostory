  play, 0N USER, 0N STORY
USER: nickname, _email, password, role
:

STORY: _title, content, image_url, slug
    contain, 1N STORY, 11 PAGE
:

:
PAGE: _title, content, image_url, slug
refer, 0N PAGE, 11 CHOICE
CHOICE : _name, description