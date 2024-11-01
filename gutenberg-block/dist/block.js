const $e74c447d1b4eb58b$export$78f81494cf02eda2 = ()=>/*#__PURE__*/ React.createElement("svg", {
        width: "21.909",
        height: "20.322201",
        viewBox: "0 0 21.909 20.322201",
        fill: "none",
        xmlns: "http://www.w3.org/2000/svg"
    }, /*#__PURE__*/ React.createElement("path", {
        d: "M 0,7.5528 V 9.43533 L 5.273,12.0663 0,14.6973 v 1.8826 l 9.068,-4.5136 z m 0,10.8869 v 1.8825 l 10.954,-5.4434 10.955,5.4434 V 18.4397 L 10.954,12.9963 Z M 10.954,5.44346 0,0 V 1.88253 L 10.954,7.32599 21.909,1.88253 V 0 Z m 10.955,7.34864 v -1.8825 l -5.273,-2.63101 5.273,-2.631 V 3.76506 L 12.841,8.27859 Z M 0,5.64759 21.909,16.5572 V 14.6747 L 0,3.76506 Z",
        fill: "#b93be4"
    }));
const $e74c447d1b4eb58b$export$aa52398f9d493761 = ()=>/*#__PURE__*/ React.createElement("svg", {
        width: "21.909",
        height: "20.322201",
        viewBox: "0 0 21.909 20.322201",
        fill: "none",
        xmlns: "http://www.w3.org/2000/svg"
    }, /*#__PURE__*/ React.createElement("path", {
        d: "M 0,7.5528 V 9.43533 L 5.273,12.0663 0,14.6973 v 1.8826 l 9.068,-4.5136 z m 0,10.8869 v 1.8825 l 10.954,-5.4434 10.955,5.4434 V 18.4397 L 10.954,12.9963 Z M 10.954,5.44346 0,0 V 1.88253 L 10.954,7.32599 21.909,1.88253 V 0 Z m 10.955,7.34864 v -1.8825 l -5.273,-2.63101 5.273,-2.631 V 3.76506 L 12.841,8.27859 Z M 0,5.64759 21.909,16.5572 V 14.6747 L 0,3.76506 Z",
        fill: "currentColor"
    }));


const { registerBlockType: $1b821459a99dc4e4$var$registerBlockType  } = wp.blocks;
const $1b821459a99dc4e4$var$Edit = ()=>{
    const { options: options  } = STAX;
    return /*#__PURE__*/ React.createElement("button", {
        className: `stax-payments-button ${options.colors}`,
        style: {
            "--bg-custom": options.bgColorCustom,
            "--text-custom": options.textColorCustom,
            "--border-custom": options.borderColorCustom
        }
    }, options.includeLogo && /*#__PURE__*/ React.createElement("span", {
        className: "stax-payments-button__logo-wrap"
    }, /*#__PURE__*/ React.createElement((0, $e74c447d1b4eb58b$export$aa52398f9d493761), null)), /*#__PURE__*/ React.createElement("span", {
        className: "stax-payments-button__text"
    }, options.text));
};
const $1b821459a99dc4e4$var$Save = ()=>/*#__PURE__*/ React.createElement($1b821459a99dc4e4$var$Edit, null);
$1b821459a99dc4e4$var$registerBlockType("stax-payments/button", {
    title: "Stax Payments Button",
    description: "Add Stax credit card payments to your website",
    icon: (0, $e74c447d1b4eb58b$export$78f81494cf02eda2),
    category: "common",
    edit: $1b821459a99dc4e4$var$Edit,
    save: $1b821459a99dc4e4$var$Save
});


//# sourceMappingURL=block.js.map
