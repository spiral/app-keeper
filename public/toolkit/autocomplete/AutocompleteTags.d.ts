import { IAutocompleteTagsOptions, IAutocompleteData, IAutocompleteDataItem } from './types';
export declare class AutocompleteTags {
    options: IAutocompleteTagsOptions;
    data: IAutocompleteData;
    items: HTMLDivElement[];
    parentNode: Element;
    isDisabled: boolean;
    constructor(options: IAutocompleteTagsOptions);
    appendTag(item: HTMLDivElement | DocumentFragment): void;
    enable(): void;
    disable(): void;
    addTag(dataItem: IAutocompleteDataItem): void;
    removeTag(dataItem: IAutocompleteDataItem): void;
    setTags(data: IAutocompleteData): void;
    clearTags(): void;
    renderTags(): void;
    renderTag(dataItem: IAutocompleteDataItem): HTMLDivElement;
    handleRemoveTag(event: MouseEvent): void;
}
