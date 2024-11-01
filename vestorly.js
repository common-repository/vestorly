(function() {

  //console.log('tinymce version: ' + tinymce.majorVersion + '.' + tinymce.minorVersion);

  var store = {
    types:  [ { value: 'carousel', text: 'carousel'}, { value: 'basic', text: 'custom'}, { value: 'vertical', text: 'vertical'} ],
    limits: [ { value: 20, text: '20' }, { value: 18, text: '18' }, { value: 16, text: '16' },
              { value: 14, text: '14' }, { value: 12, text: '12' }, { value: 10, text: '10' },
              { value: 9, text: '9' },   { value: 8, text: '8' },   { value: 7, text: '7' },
              { value: 6, text: '6' },   { value: 5, text: '5' },   { value: 4, text: '4' },
              { value: 3, text: '3' },   { value: 2, text: '2' },   { value: 1, text: '1' }],
    groups: []
  };

  getAdvisorData();

  tinymce.PluginManager.add('vestorly_button', function(editor, url) {
    editor.addButton('vestorly_button', {
      title: 'Vestorly',
      image: url + '/assets/vestorly.png',
      onclick: function(){
        if ( store.groups.length ) {
          openDialog(editor, url);
        }
      }
    });
  });

  function openDialog(editor, url) {
    if ( parseInt(tinymce.majorVersion) < 4 ){

      editor.windowManager.open({
        title: "Vestorly Shortcode",
        url: url+'/assets/vestorly_dialog.html',
        width: 350,
        height: 350,
        inline: 1
      }, { store: store });

    } else {

      var data = {
        slideshow: true,
        limit: 10,
        display: 'carousel',
        height: '270px',
        width: '100%',
        library: ''
      };

      editor.windowManager.open({
        title: 'Vestorly Shortcode',
        id: 'vestorly-insert-dialog',
        body: [
          { type: 'checkbox', name: 'slideshow', text: 'Slide show', checked: data.slideshow, onchange: function() { data.slideshow = this.checked(); } },
          { type: 'listbox', name: 'library', label: 'Library', values: store.groups, onchange: function() { data.library = this.value(); } },
          { type: 'listbox', name: 'display', label: 'Display', values: store.types, onchange: function() { data.display = this.value(); } },
          { type: 'textbox', name: 'height', label: 'Height (px)', value: data.height, onchange: function() { data.height = this.value(); } },
          { type: 'textbox', name: 'width', label: 'Width (px)', value: data.width, onchange: function() { data.width = this.value(); } },
          { type: 'listbox', name: 'limit', label: 'Limit', values: store.limits, onchange: function() { data.limit = this.value(); } },
          { type: 'checkbox', name: 'anonymous', label: 'Allow anonymous', checked: data.anonymous, onchange: function() { data.anonymous = this.checked(); } }
        ],
        onsubmit: function(e) {
          editor.insertContent('[vestorly ' + 'library=' + e.data.library + ' display=' + e.data.display  + ' height=' + e.data.height + ' width=' + e.data.width  + ' limit=' + e.data.limit + ' slideshow=' + e.data.slideshow + ' anonymous=' + e.data.anonymous + ']');
        }
      });

    }
  }

  function getAdvisorGroups(apiUrl, token) {
    var url = apiUrl + "/v2/groups",
        deferred = jQuery.Deferred();

    jQuery.ajax({
      url: url,
      type: 'GET',
      dataType: 'json',
      headers: { "x-vestorly-auth": token },
      success: function(data) {
        deferred.resolve(data.groups);
      },
      error: function(jqXHR) {
        deferred.reject();
      }
    });

    return deferred;
  }


  function getAdvisorData () {
    // Get the form template from WordPress
    jQuery.post( ajaxurl, { action: 'vestorly_get_advisor'  }, function( response ) {
      var data = JSON.parse(response);

      getAdvisorGroups(data.api_url, data.token).then(function(groups){
        for(var i=0; i<groups.length; i++) {
          store.groups.push({ value: groups[i]._id.toString(), text: groups[i].name.toString() })
        }
      })
    });
  }

})();
