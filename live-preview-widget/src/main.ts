import "./app.css";
import App from "./App.svelte";

const app = new App({
  target: document.getElementById("app"),
});

declare global {
  interface Window {
    STAX?: any;
  }
}

export default app;
