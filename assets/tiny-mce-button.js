(function () {
  tinymce.PluginManager.add("jumbo_btn", function (editor) {
    // Add a button that opens a window
    editor.addButton("stax_mce_button_key", {
      image: STAX.plugin_url + "assets/tiny-mce-button.png",
      tooltip: "Insert Stax Web Payments Button",
      onclick: function () {
        editor.windowManager.open({
          title: "Stax Web Payments Button",
          body: [
            {
              type: "textbox",
              name: "button_text",
              label: "Button Text",
              tooltip: "Plain text Only",
              value: window.STAX.options.text,
              autofocus: true,
              size: 40,
            },
          ],
          onsubmit: function (e) {
            var content = `[stax_button text="${e.data.button_text}"]`;

            editor.insertContent(content);
          },
        });
      },
    });
  });
})();
