declare type Excavation = {
    x: number;
    y: number;
    w: number;
    h: number;
};
export declare type QRProps = {
    value: string;
    size: number;
    level: 'L' | 'M' | 'Q' | 'H';
    bgColor: string;
    fgColor: string;
    style?: {
        [prop: string]: string;
    };
    includeMargin: boolean;
    imageSettings?: {
        src: string;
        height: number;
        width: number;
        excavate?: Excavation;
        x?: number;
        y?: number;
    };
};
export declare const QRCodeCanvas: (node: Element, props: QRProps) => void;
export declare const QRCodeSVG: (node: Element, props: QRProps) => void;
export declare type RootProps = QRProps & {
    renderAs: 'svg' | 'canvas';
};
export declare const QRCodeR: (node: Element, props: RootProps) => void;
export {};
