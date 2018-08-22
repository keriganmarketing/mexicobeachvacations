export default class Pagination {

    constructor(results) {
        this.to           = results.to;
        this.from         = results.from;
        this.path         = results.path;
        this.total        = results.tota;
        this.perPage      = results.per_page;
        this.currentPage  = results.current_page;
        this.lastPageUrl  = results.last_page_url;
        this.nextPageUrl  = results.next_page_url;
        this.prevPageUrl  = results.prev_page_url;
        this.firstPageUrl = results.first_page_url;
    }
}
