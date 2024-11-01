<script lang="ts">
  import Options from "./lib/Options.svelte";
  import Preview from "./lib/Preview.svelte";

  // load initial values
  let options;
  if (import.meta.env.PROD) {
    // in wordpress
    options = window.STAX.options;
  } else {
    // in development
    options = {
      text: "Pay Now",
      includeLogo: true,
      inheritFonts: true,
      colors: "dark",
      bgColorCustom: "#ffffff",
      textColorCustom: "#333333",
      borderColorCustom: "#333333",
    };
  }

  // update values
  let controller;
  $: {
    if (
      import.meta.env.PROD &&
      options &&
      Object.values(options).some((value) => value !== undefined)
    ) {
      updateSettings(options);
    }
  }

  function updateSettings(settings) {
    if (controller) controller.abort();
    controller = new AbortController();

    fetch("/?rest_route=/stax/settings", {
      signal: controller.signal,
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        "X-WP-Nonce": window.STAX.wp_nonce,
      },
      body: JSON.stringify(settings),
    }).catch((_err) => {});
  }
</script>

<main>
  <div class="button-fields">
    <Options bind:options />
  </div>
  <div class="button-preview">
    <strong>Live Preview</strong>
    <Preview bind:options />
  </div>
</main>

<style>
  main {
    display: flex;
    flex-wrap: wrap;
    text-align: left;
    color: #1d2327;
  }
  .button-fields,
  .button-preview {
    padding: 16px;
  }
  .button-fields {
    flex-basis: 300px;
    flex-grow: 2;
    border-right: 1px solid #c3c4c7;
  }
  .button-preview {
    flex-basis: 150px;
    flex-grow: 1;
    background: #f8f9fb;

    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
  }

  strong {
    text-transform: uppercase;
    margin-bottom: 50px;
    margin-top: -50px;
    color: #717171;
    letter-spacing: 0.3px;
    font-size: 16px;
  }

  :global(.wrapper) {
    border: 1px solid #c3c4c7 !important;
    box-shadow: 0px 0px 4px rgba(0, 0, 0, 0.2) !important;
    margin-left: 0 !important;
    margin-top: -342px !important;
  }
</style>
