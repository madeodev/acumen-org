# Agent instructions (Acumen / ACUMEN-ORG)

This file is the project entry point for AI assistants working in this repository. Follow it on **every** substantive task (features, bugs, refactors, architecture), not only when the user @-mentions something.

## Always load project context first

1. **Read `openmemory.md` (repo root)** before planning or changing code. It is the living index: architecture, file layout, and workflow triggers. If it conflicts with a chat guess, **`openmemory.md` wins**—update the guide when you establish new facts, per the OpenMemory workflow in `.cursor/rules/`.
2. **V2 patterns / blocks / components:** After `openmemory.md`, read **`directives/project-setup.md`** for the full build workflow (SCSS, HTML fixtures, JS, tokens). Do not improvise V2 conventions without that doc.

## Conventions

- Quick human reference for commands and high-level layout: **`CLAUDE.md`**.

## Git

- Do not push to `main` without explicit confirmation (team policy).
