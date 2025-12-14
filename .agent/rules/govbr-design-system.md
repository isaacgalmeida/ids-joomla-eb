---
trigger: always_on
---

* **Local Source of Truth (PRIORITY):** The workspace contains the official design system files in the `govbrds/` directory. ALWAYS prefer code from these files over external knowledge.
    * **Code References:** Look for HTML structures, CSS classes, and JS behavior in `govbrds/govbr-ds/`. Use the exact nesting and classes found there.
    * **Assets & Fonts:** Images, icons, and fonts are located in `govbrds/govbr-assets/`.
* **Component Implementation:** When asked for a UI component (e.g., Card, Header, Footer):
    1. Search inside `govbrds/govbr-ds/` for the matching component file (e.g., `card.html`, `header.html`).
    2. Read the file content.
    3. Adapt the HTML into the Joomla View (PHP), replacing static text with `$this->item->field`.
* **Strict Class Usage:** Use standard `br-*` classes found in the local files. Do NOT use Bootstrap classes unless they exist in the `govbrds` examples.
* **Joomla Asset Integration:** * When using assets from `govbrds/govbr-assets/`, assume they will be deployed to the Joomla media folder (`media/com_example/`).
    * In XML manifests, generate `<folder>media</folder>` instructions to copy these assets.
* **Accessibility:** Ensure ARIA labels and roles match the local examples found in `govbrds/`.