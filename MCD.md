goto, 11 PAGE, 1N PAGE
:
:

PAGE: _title, content, choice_pages, description_pages, image_url, slug
  play, 0N USER, 0N STORY
USER: nickname, _email, password, role

    contain, 1N STORY, 11 PAGE
STORY: _title, content, image_url, slug
: