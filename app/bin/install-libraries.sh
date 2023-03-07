#!/usr/bin/env sh

set -e

build="/build"

installLibrary() {
    (mkdir -p "$build/$1" && cd "$build/$1" && wget -O - "$2" | tar -xz --strip-components=1)
}

installLibrary flux-eco-query-actions https://github.com/flux-eco/flux-eco-query-actions/archive/refs/tags/v2023-03-06-11.tar.gz
cd /build/flux-eco-query-actions
npm install
cd /
installLibrary flux-eco https://github.com/flux-eco/flux-eco/archive/refs/tags/v2023-03-06-2.tar.gz
installLibrary flux-eco-node-http-server https://github.com/flux-eco/flux-eco-node-http-server/archive/refs/tags/v2023-03-06-1.tar.gz

