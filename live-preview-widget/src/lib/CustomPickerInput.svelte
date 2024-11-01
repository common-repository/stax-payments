<script>
  export let button;
  export let color;
  export let label;
  /* svelte-ignore unused-export-let */
  export let isOpen;
</script>

<button bind:this={button} class="stax-color-picker">
  <div style="background-color: {color.hex};" />
  <span>{label}</span>
</button>
<input type="hidden" value={color.hex} />

<style>
  button {
    display: flex;
    align-items: center;
    padding: 0;
    background-color: #f8f9fb;
    border: 1px solid #c3c4c7;
    border-radius: 3px;
    cursor: pointer;

    outline: 3px solid transparent;
    outline-offset: 3px;
    transition: all 150ms ease-in-out;
  }
  button:focus-visible {
    box-shadow: 0 0 0 1px #2271b1;
    outline: 2px solid transparent;
  }
  button:hover {
    opacity: 0.7;
  }
  div {
    width: 40px;
    height: 32px;
    pointer-events: none;
  }
  span {
    padding: 0 6px;
    pointer-events: none;
  }
</style>
