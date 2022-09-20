:
:
:
:
CHOICE : _name, description

:
:
:
:
refer, 0N PAGE, 11 CHOICE

USER: nickname, _email, password, role
  play, 0N USER, 0N STORY: start_at
STORY: _title, content, image_url, slug
    contain, 1N STORY, 11 PAGE
PAGE: _title, content, image_url, start, end, slug