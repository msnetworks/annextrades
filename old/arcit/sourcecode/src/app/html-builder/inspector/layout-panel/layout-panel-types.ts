export interface Container {
    node: HTMLElement,
    rows: HTMLElement[],
    id: string,
}

export interface Column {
    node: HTMLElement, span: number, id: string
}

export type Columns = Column[];