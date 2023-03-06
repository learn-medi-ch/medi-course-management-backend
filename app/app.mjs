#!/usr/bin/env node
import '../../flux-eco/types/flux-eco-app-types.mjs';

import fs from "node:fs";
import {FluxEcoNodeHttpServer} from '../../flux-eco-node-http-server/app/server/FluxEcoNodeHttpServer.mjs';
import {FluxEcoQueryActionsApi} from './../../flux-eco-query-actions/app/src/Adapters/Api/FluxEcoQueryActionsApi.mjs';
import {Api} from "./src/Adapters/Api/Api.mjs";


async function app() {
    const jsonString = fs.readFileSync("/opt/medi-course-management-backend/app/config/config.json", 'utf-8'); //todo
    const configObject =  await JSON.parse(jsonString);
    const resolvedConfigObject =  /** @type {FluxEcoAppConfig} */ resolveEnvVariables(configObject);

    const queryActionApi = await FluxEcoQueryActionsApi.newMysqlSourceQueryActions(
        resolvedConfigObject.outboundsConfigs.iliasDatabase
    );

    const boundedActions = {
        getRepositoryTree: async () => {
            const action = await resolvedConfigObject.outboundsConfigs.iliasDatabase.boundActions.getRepositoryTree;
            /**
             * @type QueryMysqlDataSource
             */
            return await queryActionApi[action.actionName](
                action.actionParameters
            );
        }
    };

    const api = await Api.new(boundedActions);


    const server = await FluxEcoNodeHttpServer.new(resolvedConfigObject.inboundsConfig.httpBindingConfig, api);
    // Start the server
    server.start();
}

function resolveEnvVariables(object) {
    if (object === null) {
        return object;
    }

    if (typeof object !== 'object') {
        return object;
    }

    const resolved = Array.isArray(object) ? [] : {};

    for (const [key, value] of Object.entries(object)) {
        if (typeof value === 'string' && value.startsWith('$')) {
            const envVar = value.slice(1);
            const envVarName = envVar.replace(/[{}]/g, '');
            resolved[key] = process.env[envVarName];
        } else {
            resolved[key] = resolveEnvVariables(value);
        }
    }

    return resolved;
}

app();
