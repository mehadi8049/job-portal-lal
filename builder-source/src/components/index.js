export default (editor, config = {}) => {
    const domc = editor.DomComponents;
    const defaultType = domc.getType('default');
    const defaultModel = defaultType.model;
    const defaultView = defaultType.view;
    
    // Update image component toolbar
    const typeImage = domc.getType('image').model;

    domc.addType('image', {
        model: {
            initToolbar() {
                typeImage.prototype.initToolbar.apply(this, arguments);
                const tb = this.get('toolbar');
                const tbExists = tb.some(item => item.command === 'open-assets');

                if (!tbExists) {
                    tb.unshift({
                      command: editor => editor.runCommand('open-assets', {
                          target: editor.getSelected(),
                      }),
                      label: `<i class="fas fa-images"></i>`,
                    });
                    this.set('toolbar', tb);
                }
            }
        }
    });

    // Update image component toolbar
    
    const typeDefault = domc.getType('default').model;

    //Define a new icon component
    domc.addType('icon-component', {
      isComponent: function(el) {
          var result = '';
          if(el.tagName == 'I'){
              result = {type: 'icon-component'};
          }
          return result;
      },
      model: {
        initToolbar() {
            typeDefault.prototype.initToolbar.apply(this, arguments);
            const tb = this.get('toolbar');
            const tbExists = tb.some(item => item.attributes.name == 'open-icons-modal');
            if (!tbExists) {
                tb.unshift({
                  command: editor => editor.runCommand('open-icons-modal'),
                  attributes: {class: "fas fa-pen", name: 'open-icons-modal'},
                });
                this.set('toolbar', tb);
            }

        }
      }
    });

    editor.AssetManager.addType('image', {
      view: {
        onRemove(e) {
          e.stopPropagation();
          const model = this.model;
          confirm('Are you sure?') && model.collection.remove(model);
        }
      },
    });

    // Define a new custom component
    editor.Components.addType('stripe-button', {
      isComponent: function(el) {
          var result = '';

          if(el.tagName == 'BUTTON' && el.className == 'builder-stripe-button' ){
              result = {type: 'stripe-button'};
          }
          return result;
      },
      model: {
        defaults: {
          tagName: 'button',
          attributes: { class: 'builder-stripe-button', type: 'button'},
          productid: '',
          traits: [
            {
              type: 'select',
              name: 'productid',
              label: 'Select a Product',
              changeProp: 0,
              options: getProducts(),
            }
          ],
          //'script-props': ['productid'],
        }
        
      }
    });

    
}
