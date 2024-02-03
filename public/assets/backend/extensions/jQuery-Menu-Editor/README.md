# jQuery Menu Editor 2.1.2

## Forked from [davicotico/jQuery-Menu-Editor](https://github.com/davicotico/jQuery-Menu-Editor)

### Features

- Add, Update & Remove items from Menu
- Multilevel Drag & Drop
- Form Item Editor
- Include IconPicker Plugin (https://victor-valencia.github.io/bootstrap-iconpicker)
- Support for mobile devices
- Load data from JSON string
- The output is a JSON string

This project is based on jQuery-Sortable-lists (v1.4.0) http://camohub.github.io/jquery-sortable-lists/index.html and added many features.

# Documentation

## Requirements

- Bootstrap 5.x
- jQuery >= 3.x
- Fontawesome 5.15.4
- Bootstrap Iconpicker 1.10.0

## How to use

### Include the Css and scripts

```html
<!-- the css inside the <head> -->
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
  integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N"
  crossorigin="anonymous" />
<link
  rel="stylesheet"
  href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
<link
  rel="stylesheet"
  href="dist/bootstrap-iconpicker/css/bootstrap-iconpicker.min.css" />

<!-- (Recommended) Just before the closing body tag </body> -->
<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script
  src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
  crossorigin="anonymous"></script>
<script
  type="text/javascript"
  src="dist/bootstrap-iconpicker/js/iconset/fontawesome5-3-1.min.js"></script>
<script
  type="text/javascript"
  src="dist/bootstrap-iconpicker/js/bootstrap-iconpicker.min.js"></script>
<script type="text/javascript" src="jquery-menu-editor.min.js"></script>
```

## Creating Html

- [Manual one by one](#creating-the-drag--drop-list)
- [All in one](#creating-all-html-content)

<hr>

### Creating the Drag & Drop list

```html
<ul id="myEditor" class="sortableLists list-group"></ul>
```

<hr>

### Creating the form

- The inputs for items should be have the class="item-menu"
- The icon picker should be have the id=[LIST_ID]+"\_icon"

```html
<div class="card">
  <div class="card-header">
    <h4 class="card-title">Form</h4>
  </div>
  <div class="card-body">
    <form class="form-horizontal" id="frmEdit">
      <div class="form-group">
        <label for="text">Text</label>
        <div class="input-group">
          <input
            type="text"
            class="form-control item-menu"
            name="text"
            id="text"
            placeholder="Text" />
          <div class="input-group-append">
            <button
              type="button"
              class="btn btn-outline-secondary"
              id="myEditor_icon"></button>
          </div>
        </div>
        <input type="hidden" class="item-menu" name="icon" />
      </div>
      <div class="form-group">
        <label for="href">URL</label>
        <input
          type="text"
          class="form-control item-menu"
          name="href"
          id="href"
          placeholder="URL" />
      </div>
      <div class="form-group">
        <label for="target">Target</label>
        <select class="form-control item-menu" name="target" id="target">
          <option value="_self">Self</option>
          <option value="_blank">Blank</option>
          <option value="_top">Top</option>
        </select>
      </div>
      <div class="form-group">
        <label for="title">Tooltip</label>
        <input
          type="text"
          class="form-control item-menu"
          name="title"
          id="title"
          placeholder="Tooltip" />
      </div>
    </form>
  </div>
  <div class="card-footer">
    <button type="button" class="btn btn-primary" id="btnUpdate" disabled>
      <i class="fas fa-sync-alt"></i> Update
    </button>
    <button type="button" class="btn btn-success" id="btnAdd">
      <i class="fas fa-plus"></i> Add
    </button>
  </div>
</div>
```

<hr>

### Creating output

```html
<div class="card">
  <div class="card-header">
    <div class="float-start">
      <h4 class="card-title">Output</h4>
    </div>
    <div class="float-end">
      <button type="button" class="btn btn-outline-secondary" id="btnOutput">
        <i class="fa fa-play"></i> Get Output
      </button>
    </div>
  </div>
  <div class="card-body">
    <textarea
      class="form-control"
      id="myTextarea"
      cols="30"
      rows="10"></textarea>
  </div>
</div>
```

<hr>

### Create and Setting the MenuEditor object

```javascript
// icon picker options
var iconPickerOptions = { searchText: "Buscar...", labelHeader: "{0}/{1}" };

// sortable list options
var sortableListOptions = {
  placeholderCss: { "background-color": "#cccccc" },
};

var editor = new MenuEditor("myEditor", {
  listOptions: sortableListOptions,
  iconPicker: iconPickerOptions,
  maxLevel: 2, // (Optional) Default is -1 (no level limit)
  // Valid levels are from [0, 1, 2, 3,...N]
  autoResetForm: ["add", "edit"], // (Optional) if set to null when click button edit or update the form will not resetted
});

editor.setForm($("#frmEdit"));
editor.setUpdateButton($("#btnUpdate"));

//Calling the update method
$("#btnUpdate").click(function () {
  editor.update();
});

// Calling the add method
$("#btnAdd").click(function () {
  editor.add();
});
```

### Load data from a Json

We have the method setData:

```javascript
var arrayJson = [
  {
    href: "http://home.com",
    icon: "fas fa-home",
    text: "Home",
    target: "_top",
    title: "My Home",
  },
  { icon: "fas fa-chart-bar", text: "Option 2" },
  { icon: "fas fa-bell", text: "Option 3" },
  { icon: "fas fa-crop", text: "Option 4" },
  { icon: "fas fa-flask", text: "Option 5" },
  { icon: "fas fa-map-marker", text: "Option 6" },
  {
    icon: "fas fa-search",
    text: "Multilevel",
    children: [
      {
        icon: "fas fa-plug",
        text: "Multilevel-1",
        children: [{ icon: "fas fa-filter", text: "Multilevel-1-1" }],
      },
    ],
  },
];

editor.setData(arrayJson);
```

### Output

We have the function getString

```javascript
var str = editor.getString();
$("#myTextarea").text(str);
```

<hr>

### Creating All Html content

```html
<div class="row">
  <div class="col-6">
    <div class="card">
      <div class="card-header">
        <div class="float-start">
          <h4 class="card-title">List Menu</h4>
        </div>
        <div class="float-end">
          <button
            type="button"
            class="btn btn-outline-secondary"
            id="btnReload">
            <i class="fa fa-play"></i> Load Data
          </button>
        </div>
      </div>
      <div class="card-body">
        <ul class="sortableLists list-group" id="myEditor"></ul>
      </div>
    </div>
  </div>
  <div class="col-6">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Form</h4>
      </div>
      <div class="card-body">
        <form class="form-horizontal" id="frmEdit">
          <div class="form-group">
            <label for="text">Text</label>
            <div class="input-group">
              <input
                type="text"
                class="form-control item-menu"
                name="text"
                id="text"
                placeholder="Text" />
              <div class="input-group-append">
                <button
                  type="button"
                  class="btn btn-outline-secondary"
                  id="myEditor_icon"></button>
              </div>
            </div>
            <input type="hidden" class="item-menu" name="icon" />
          </div>
          <div class="form-group">
            <label for="href">URL</label>
            <input
              type="text"
              class="form-control item-menu"
              name="href"
              id="href"
              placeholder="URL" />
          </div>
          <div class="form-group">
            <label for="target">Target</label>
            <select class="form-control item-menu" name="target" id="target">
              <option value="_self">Self</option>
              <option value="_blank">Blank</option>
              <option value="_top">Top</option>
            </select>
          </div>
          <div class="form-group">
            <label for="title">Tooltip</label>
            <input
              type="text"
              class="form-control item-menu"
              name="title"
              id="title"
              placeholder="Tooltip" />
          </div>
        </form>
      </div>
      <div class="card-footer">
        <button type="button" class="btn btn-primary" id="btnUpdate" disabled>
          <i class="fas fa-sync-alt"></i> Update
        </button>
        <button type="button" class="btn btn-success" id="btnAdd">
          <i class="fas fa-plus"></i> Add
        </button>
      </div>
    </div>
  </div>
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <div class="float-start">
          <h4 class="card-title">Output</h4>
        </div>
        <div class="float-end">
          <button
            type="button"
            class="btn btn-outline-secondary"
            id="btnOutput">
            <i class="fa fa-play"></i> Get Output
          </button>
        </div>
      </div>
      <div class="card-body">
        <textarea
          class="form-control"
          id="myTextarea"
          cols="30"
          rows="10"></textarea>
      </div>
    </div>
  </div>
</div>
```

### Creating Javascript

```javascript
 // icon picker options
        var iconPickerOptions = {
            searchText: "Search...",
            labelHeader: "{0} / {1}"
        };

        // sortable list options
        var sortableListOptions = {
            placeholderCss: {
                'background-color': "#cccccc"
            }
        };

        var editor = new MenuEditor('myEditor', {
            listOptions: sortableListOptions,
            iconPicker: iconPickerOptions,
            maxLevel: 2 // (Optional) Default is -1 (no level limit)
            // Valid levels are from [0, 1, 2, 3,...N]
            autoResetForm: ['add', 'edit'], // (Optional) if set to null when click button edit or update the form will not resetted
        });

        editor.setForm($('#frmEdit'));
        editor.setUpdateButton($('#btnUpdate'));

        // Calling the update method
        $("#btnUpdate").click(function() {
            editor.update();
        });

        // Calling the add method
        $('#btnAdd').click(function() {
            editor.add();
        });

        // load data json to List Menu
        $('#btnReload').click(function() {
            var arrayJson = [{href:"http://home.com",icon:"fas fa-home",text:"Home",target:"_top",title:"My Home"},{icon:"fas fa-chart-bar",text:"Option 2"},{icon:"fas fa-bell",text:"Option 3"},{icon:"fas fa-crop",text:"Option 4"},{icon:"fas fa-flask",text:"Option 5"},{icon:"fas fa-map-marker",text:"Option 6"},{icon:"fas fa-search",text:"Multilevel",children:[{icon:"fas fa-plug",text:"Multilevel-1",children:[{icon:"fas fa-filter",text:"Multilevel-1-1"}]}]}];

            editor.setData(arrayJson);
        });

        // get output of list menu
        $('#btnOutput').click(function() {
            var str = editor.getString();
            $("#myTextarea").text(str);
        });
```

### Know Bugs

- Broken Bootstrap 5 Icon
- Broken icon list position
- Typo variable

#### Fixing

- Bootstrap 5 Support

  - [Issue - Broken with Bootstrap 5](https://github.com/davicotico/jQuery-Menu-Editor/issues/26)
    - [Code](https://github.com/davicotico/jQuery-Menu-Editor/issues/26#issuecomment-1053689589)

- Bootstrap 5 Icon :
  - [Issue - Bootstrap 5 Support](https://github.com/victor-valencia/bootstrap-iconpicker/issues/100#issuecomment-954515363)
    - [Code](https://github.com/pweinzettel/bootstrap-iconpicker/blob/master/dist/js/bootstrap-iconpicker.js)
