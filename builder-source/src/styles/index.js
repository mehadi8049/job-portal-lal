export default (editor, config) => {
    const sm = editor.StyleManager;
    const csm = config.customStyleManager;

    sm.getSectors().reset(csm && csm.length ? csm : [
        {
            name: config.textTypography,
            open: false,
            buildProps: ["color", "font-size", "font-weight", "letter-spacing", "line-height", "text-align"],
            properties: [{
                property: 'text-align',
                list: [{
                        value: 'left',
                        className: 'fa fa-align-left'
                    },
                    {
                        value: 'center',
                        className: 'fa fa-align-center'
                    },
                    {
                        value: 'right',
                        className: 'fa fa-align-right'
                    },
                    {
                        value: 'justify',
                        className: 'fa fa-align-justify'
                    },
                ],
            }]
        },
        {
            name: config.textBackground,
            open: !1,
            buildProps: ["background-color", "background"]
        },

        {
            name: config.textBorder,
            open: !1,
            buildProps: ["border"]
        }
    ]);
}