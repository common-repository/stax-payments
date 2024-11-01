<script lang="ts">
  import Logo from "./Logo.svelte";

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

<button
  class="stax-payments-button {options.colors || ''}"
  style="--bg-custom: {options.bgColorCustom}; --text-custom: {options.textColorCustom}; --border-custom: {options.borderColorCustom};"
  on:click|preventDefault={(e) => e.currentTarget.blur()}
>
  {#if options.includeLogo}
    <span class="stax-payments-button__logo-wrap">
      <Logo />
    </span>
  {/if}
  <span class="stax-payments-button__text">{options.text}</span>
</button>
