/**
 * @typedef {Object} MediCourseManagementBackend
 * @property {Outbounds} outbounds
 */

/**
 * @typedef {Object} Outbounds
 * @property {function} getRepositoryTree
 */

export class Api {

    #boundedActions

    constructor(boundedActions) {
        this.#boundedActions = boundedActions
    }

    /**

     * @return {Promise<Api>}
     */
    static async new(boundedActions) {
        return new Api(boundedActions);
    }

    /**
     * Returns the repository tree.
     * @returns {Promise<Object>}
     */
    async readPageStructure() {
        return await this.#boundedActions.getRepositoryTree();
    }

}