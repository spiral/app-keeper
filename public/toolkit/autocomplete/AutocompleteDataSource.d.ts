import { IAutocompleteDataSourceOptions, IAutocompleteDataItem, IDatagridRequest } from './types';
export declare class AutocompleteDataSource {
    options: IAutocompleteDataSourceOptions;
    isDynamic: boolean;
    constructor(options: IAutocompleteDataSourceOptions);
    getData(search: string): void;
    restoreDataItem(values: string[]): void;
    restoreDataItemFromData(values: string[]): void;
    restoreDataItemByUrl(values: string[]): void;
    handleRestoreSuccess(values: string[], results: IAutocompleteDataItem[]): void;
    getResultsFromData(search: string): void;
    getResultsByURL(search: string): void;
    getRequestParams(data: IDatagridRequest): {
        method: "GET" | "POST";
        headers: {
            [key: string]: string;
        };
        url: string;
    };
}
