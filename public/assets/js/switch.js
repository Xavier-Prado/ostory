/**
 *  Light Switch @version v0.1.4
 */

(function () {
  let lightSwitch = document.getElementById('lightSwitch');
  if (!lightSwitch) {
    return;
  }

  function replaceClass(elementArray, classToReplace, newClass) {
    elementArray.forEach((element) => {
      if(document.querySelector(element)) {
          document.querySelector(element).classList.remove(classToReplace);
          document.querySelector(element).classList.add(newClass);
      }
    })
  }

  function replacePaginationClass(element, classToReplace, newClass){
    paginationElements = document.querySelectorAll(element);
    paginationElements.forEach((element) => {
      if((element)) {
          element.classList.remove(classToReplace);
          element.classList.add(newClass);
      }
    })
  }


  /**
   * @function darkmode
   * @summary: changes the theme to 'dark mode' and save settings to local storage.
   * Basically, replaces/toggles every CSS class that has '-light' class with '-dark'
   */
  function darkMode(elementArray) {
    document.querySelectorAll('.bg-light').forEach((element) => {
      element.className = element.className.replace(/-light/g, '-dark');
    });

    // Tables
    var tables = document.querySelectorAll('table');
    for (var i = 0; i < tables.length; i++) {
      // add table-dark class to each table
      tables[i].classList.add('table-dark');
    }

    document.body.classList.add('bg-dark');

    if (document.body.classList.contains('text-dark')) {
          document.body.classList.replace('text-dark', 'text-light');
          replaceClass(elementArray, 'text-dark', 'text-light');
          replacePaginationClass('ul.pagination', 'pagination', 'pagination-light');
          replacePaginationClass('.disabled', 'disabled', 'disabled-light');
    } else {
      document.body.classList.add('text-light')
      replaceClass(elementArray, 'text-dark', 'text-light');

      if(document.querySelector('ul.pagination-light')) {
        document.querySelector('ul.pagination-light').classList.replace('pagination-light', 'pagination');
      } else {
        replacePaginationClass('ul.pagination', 'pagination', 'pagination-light');
      }

      if(document.querySelector('.disabled-light')) {
        document.querySelector('.disabled-light').classList.replace('disabled-light', 'disabled');
      } else {
        replacePaginationClass('.disabled', 'disabled', 'disabled-light');
      }
    }

    // set light switch input to true
    if (!lightSwitch.checked) {
      lightSwitch.checked = true;
    }
    localStorage.setItem('lightSwitch', 'dark');
  }

  /**
   * @function lightmode
   * @summary: changes the theme to 'light mode' and save settings to local stroage.
   */
  function lightMode(elementArray) {
    document.querySelectorAll('.bg-dark').forEach((element) => {
      element.className = element.className.replace(/-dark/g, '-light');
    });

    // Tables
    var tables = document.querySelectorAll('table');
    for (var i = 0; i < tables.length; i++) {
      if (tables[i].classList.contains('table-dark')) {
        tables[i].classList.remove('table-dark');
      }
    }

    document.body.classList.add('bg-light');

    if (document.body.classList.contains('text-light')) {
        document.body.classList.replace('text-light', 'text-dark');
        replaceClass(elementArray, 'text-light', 'text-dark');
        replacePaginationClass('ul.pagination-light', 'pagination-light', 'pagination');
        replacePaginationClass('.disabled-light', 'disabled-light', 'disabled');
    } else {
      document.body.classList.add('text-dark')
      replaceClass(elementArray, 'text-light', 'text-dark');

      if(document.querySelector('ul.pagination-light')) {
          replacePaginationClass('ul.pagination-light', 'pagination-light', 'pagination');
      }

      if(document.querySelector('.disabled-light')) {
        document.querySelector('.disabled-light').classList.replace('disabled-light', 'disabled');
      } else {
        replacePaginationClass('.disabled-light', 'disabled-light', 'disabled');
      }
    }

    if (lightSwitch.checked) {
      lightSwitch.checked = false;
    }
    localStorage.setItem('lightSwitch', 'light');
  }

  function formControlClassUpdate(){
    formControlElements = document.querySelectorAll('.form-control');
    formSelectElements = document.querySelectorAll('.form-select');
    formControlElements.forEach((formControlElement) => formControlElement.classList.toggle('form-control-dark'));
    formSelectElements.forEach((formControlElement) => formControlElement.classList.toggle('form-select-dark'));
  }

  function formControlSetUp(){
    formControlElements = document.querySelectorAll('.form-control');
    formSelectElements = document.querySelectorAll('.form-select');
    formSelectElements.forEach((formControlElement) => formControlElement.classList.add('form-select-dark'));
    formControlElements.forEach((formControlElement) => formControlElement.classList.add('form-control-dark'));
  }

  /**
   * @function onToggleMode
   * @summary: the event handler attached to the switch. calling @darkMode or @lightMode depending on the checked state.
   */
  function onToggleMode() {
    const elementArray = ['h1', 'small>a', 'h4'];
    if (lightSwitch.checked) {
      darkMode(elementArray);
    } else {
      lightMode(elementArray);
    }
    formControlClassUpdate();
  }

  /**
   * @function getSystemDefaultTheme
   * @summary: get system default theme by media query
   */
  function getSystemDefaultTheme() {
    const darkThemeMq = window.matchMedia('(prefers-color-scheme: dark)');
    if (darkThemeMq.matches) {
      return 'dark';
    }
    return 'light';
  }

  function setup() {
    var settings = localStorage.getItem('lightSwitch');
    if (settings == null) {
      settings = getSystemDefaultTheme();
    }

    if (settings == 'dark') {
      lightSwitch.checked = true;
    } else {
      formControlSetUp();
    }

    lightSwitch.addEventListener('change', onToggleMode);
    onToggleMode();
  }

  setup();
})();
