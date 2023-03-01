export class Api {
    /**
     * @param {string, function} boundActions
     */
    #boundActions
    /**
     * @param {RepositoryTreeHandler}
     */
    #repositoryTreeHandler

    /**
     * @param {string, function} boundActions
     */
    constructor(boundActions) {
        this.#boundActions = boundActions
    }

    /**
     * @param {string, function} boundActions
     * @return {Promise<Api>}
     */
    static async new(boundActions) {
        return new Api(boundActions);
    }

    /**
     * Returns the repository tree.
     * @returns {Promise<Object>}
     */
    async getRepositoryTree() {

    }

}
