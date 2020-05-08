import { IAutocompleteDropdownOptions, IAutocompleteData, IAutocompleteDataItem } from './types';
export declare class AutocompleteDropdown {
    node: HTMLDivElement;
    options: IAutocompleteDropdownOptions;
    items?: HTMLDivElement[];
    data?: IAutocompleteData;
    selectedIndex: number;
    isDisabled: boolean;
    isInnerFocus?: boolean;
    constructor(options: IAutocompleteDropdownOptions);
    show(): void;
    hide(): boolean;
    clear(): void;
    enable(): void;
    disable(): void;
    setData(data: IAutocompleteData): void;
    suggest(query: string): boolean;
    render(): void;
    redrawItems(): void;
    renderItem(index: number, dataItem: IAutocompleteDataItem): HTMLDivElement;
    focusSelectedItem(): void;
    selectIndex(index: number): void;
    clearIndex(): void;
    handleClickItem(event: MouseEvent): void;
    handleFocusItem(event: FocusEvent): void;
    handleKeyDownItem(event: KeyboardEvent): void;
}
