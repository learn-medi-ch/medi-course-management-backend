import Api from "./src/Adapters/Api/Api.mjs";
import {FluxEcoHttpServer} from './../../flux-eco-http-server/app/server/FluxEcoHttpServer.mjs';

async function app() {
    const appConfig = new FluxEcoConfig(JSON.parse(await import("./config/fluxEcoConfig.json")));

    const api = Api.new();

    const middlewares = [];
    const middlewareChain = new MiddlewareChain(middlewares);

    const server = await FluxEcoHttpServer.new(appConfig.server, middlewareChain);
    // Start the server
    server.start();
}

app();
