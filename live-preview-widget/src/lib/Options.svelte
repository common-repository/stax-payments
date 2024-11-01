<script lang="ts">
  import ColorPicker, { CircleVariant } from "svelte-awesome-color-picker";
  import CustomPickerInput from "./CustomPickerInput.svelte";

  export let options = {
    text: "",
    includeLogo: true,
    inheritFonts: true,
    colors: "",
    bgColorCustom: "",
    textColorCustom: "",
    borderColorCustom: "",
  };
</script>

<div class="option">
  <div class="option-heading">Button Text</div>
  <input type="text" bind:value={options.text} />

  <label class="checkbox">
    <input type="checkbox" bind:checked={options.includeLogo} />
    Include Stax logo?
  </label>
</div>

<div class="option radio">
  <div class="option-heading">Button Colors</div>
  <label class="radio-label">
    <input
      type="radio"
      name="colors"
      value="dark"
      bind:group={options.colors}
    />
    Stax Dark
  </label>
  <label class="radio-label">
    <input
      type="radio"
      name="colors"
      value="light"
      bind:group={options.colors}
    />
    Stax Light
  </label>
  <label class="radio-label">
    <input
      type="radio"
      name="colors"
      value="custom"
      bind:group={options.colors}
    />
    Custom
  </label>
</div>

{#if options.colors === "custom"}
  <div class="pickers">
    <div>
      <div class="option-heading">Background color</div>
      <ColorPicker
        bind:hex={options.bgColorCustom}
        components={{ ...CircleVariant, input: CustomPickerInput }}
      />
    </div>

    <div>
      <div class="option-heading">Text color</div>
      <ColorPicker
        bind:hex={options.textColorCustom}
        components={{ ...CircleVariant, input: CustomPickerInput }}
      />
    </div>

    <div>
      <div class="option-heading">Border color</div>
      <ColorPicker
        bind:hex={options.borderColorCustom}
        components={{ ...CircleVariant, input: CustomPickerInput }}
      />
    </div>
  </div>
{/if}

<style>
  input[type="text"] {
    padding: 4px 6px;
    font-size: 14px;
  }

  .option {
    margin-bottom: 1.5rem;
  }
  .option ~ .option {
    margin-top: 1.5rem;
  }

  .option:last-of-type {
    margin-bottom: 0;
  }

  .option-heading {
    display: block;
    margin-bottom: 0.75rem;
    font-weight: bold;
  }

  .checkbox {
    display: block;
    margin-top: 12px;
  }

  .radio {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
  }

  .radio-label {
    cursor: pointer;
    padding: 6px 0;
  }

  .pickers {
    display: flex;
    gap: 2rem;
  }
</style>
