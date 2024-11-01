import { StaxPurple, StaxIcon } from "./icons";
const { registerBlockType } = wp.blocks;

const Edit = () => {
  const { options } = STAX;

  return (
    <button
      className={`stax-payments-button ${options.colors}`}
      style={{
        "--bg-custom": options.bgColorCustom,
        "--text-custom": options.textColorCustom,
        "--border-custom": options.borderColorCustom,
      }}
    >
      {options.includeLogo && (
        <span className="stax-payments-button__logo-wrap">
          <StaxIcon />
        </span>
      )}
      <span className="stax-payments-button__text">{options.text}</span>
    </button>
  );
};

const Save = () => <Edit />;

registerBlockType("stax-payments/button", {
  title: "Stax Payments Button",
  description: "Add Stax credit card payments to your website",
  icon: StaxPurple,
  category: "common",
  edit: Edit,
  save: Save,
});
